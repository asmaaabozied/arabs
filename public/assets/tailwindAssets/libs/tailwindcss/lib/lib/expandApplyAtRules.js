"use strict";
Object.defineProperty(exports, "__esModule", {
    value: true
});
Object.defineProperty(exports, "default", {
    enumerable: true,
    get: function() {
        return expandApplyAtRules;
    }
});
const _postcss = /*#__PURE__*/ _interop_require_default(require("postcss"));
const _postcssselectorparser = /*#__PURE__*/ _interop_require_default(require("postcss-selector-parser"));
const _generateRules = require("./generateRules");
const _escapeClassName = /*#__PURE__*/ _interop_require_default(require("../util/escapeClassName"));
const _applyImportantSelector = require("../util/applyImportantSelector");
const _pseudoElements = require("../util/pseudoElements");
function _interop_require_default(obj) {
    return obj && obj.__esModule ? obj : {
        default: obj
    };
}
/** @typedef {Map<string, [any, import('postcss').Rule[]]>} ApplyCache */ function extractClasses(node) {
    /** @type {Map<string, Set<string>>} */ let groups = new Map();
    let container = _postcss.default.root({
        nodes: [
            node.clone()
        ]
    });
    container.walkRules((rule)=>{
        (0, _postcssselectorparser.default)((selectors)=>{
            selectors.walkClasses((classSelector)=>{
                let parentSelector = classSelector.parent.toString();
                let classes = groups.get(parentSelector);
                if (!classes) {
                    groups.set(parentSelector, classes = new Set());
                }
                classes.add(classSelector.value);
            });
        }).processSync(rule.selector);
    });
    let normalizedGroups = Array.from(groups.values(), (classes)=>Array.from(classes));
    let classes = normalizedGroups.flat();
    return Object.assign(classes, {
        groups: normalizedGroups
    });
}
let selectorExtractor = (0, _postcssselectorparser.default)();
/**
 * @param {string} ruleSelectors
 */ function extractSelectors(ruleSelectors) {
    return selectorExtractor.astSync(ruleSelectors);
}
function extractBaseCandidates(candidates, separator) {
    let baseClasses = new Set();
    for (let candidate of candidates){
        baseClasses.add(candidate.split(separator).pop());
    }
    return Array.from(baseClasses);
}
function prefix(context, selector) {
    let prefix = context.tailwindConfig.prefix;
    return typeof prefix === "function" ? prefix(selector) : prefix + selector;
}
function* pathToRoot(node) {
    yield node;
    while(node.parent){
        yield node.parent;
        node = node.parent;
    }
}
/**
 * Only clone the node itself and not its children
 *
 * @param {*} node
 * @param {*} overrides
 * @returns
 */ function shallowClone(node, overrides = {}) {
    let children = node.nodes;
    node.nodes = [];
    let tmp = node.clone(overrides);
    node.nodes = children;
    return tmp;
}
/**
 * Clone just the nodes all the way to the top that are required to represent
 * this singular rule in the tree.
 *
 * For example, if we have CSS like this:
 * ```css
 * @media (min-width: 768px) {
 *   @supports (display: grid) {
 *     .foo {
 *       display: grid;
 *       grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
 *     }
 *   }
 *
 *   @supports (backdrop-filter: blur(1px)) {
 *     .bar {
 *       backdrop-filter: blur(1px);
 *     }
 *   }
 *
 *   .baz {
 *     color: orange;
 *   }
 * }
 * ```
 *
 * And we're cloning `.bar` it'll return a cloned version of what's required for just that single node:
 *
 * ```css
 * @media (min-width: 768px) {
 *   @supports (backdrop-filter: blur(1px)) {
 *     .bar {
 *       backdrop-filter: blur(1px);
 *     }
 *   }
 * }
 * ```
 *
 * @param {import('postcss').Node} node
 */ function nestedClone(node) {
    for (let parent of pathToRoot(node)){
        if (node === parent) {
            continue;
        }
        if (parent.type === "root") {
            break;
        }
        node = shallowClone(parent, {
            nodes: [
                node
            ]
        });
    }
    return node;
}
/**
 * @param {import('postcss').Root} root
 */ function buildLocalApplyCache(root, context) {
    /** @type {ApplyCache} */ let cache = new Map();
    root.walkRules((rule)=>{
        // Ignore rules generated by Tailwind
        for (let node of pathToRoot(rule)){
            var _node_raws_tailwind;
            if (((_node_raws_tailwind = node.raws.tailwind) === null || _node_raws_tailwind === void 0 ? void 0 : _node_raws_tailwind.layer) !== undefined) {
                return;
            }
        }
        // Clone what's required to represent this singular rule in the tree
        let container = nestedClone(rule);
        let sort = context.offsets.create("user");
        for (let className of extractClasses(rule)){
            let list = cache.get(className) || [];
            cache.set(className, list);
            list.push([
                {
                    layer: "user",
                    sort,
                    important: false
                },
                container
            ]);
        }
    });
    return cache;
}
/**
 * @returns {ApplyCache}
 */ function buildApplyCache(applyCandidates, context) {
    for (let candidate of applyCandidates){
        if (context.notClassCache.has(candidate) || context.applyClassCache.has(candidate)) {
            continue;
        }
        if (context.classCache.has(candidate)) {
            context.applyClassCache.set(candidate, context.classCache.get(candidate).map(([meta, rule])=>[
                    meta,
                    rule.clone()
                ]));
            continue;
        }
        let matches = Array.from((0, _generateRules.resolveMatches)(candidate, context));
        if (matches.length === 0) {
            context.notClassCache.add(candidate);
            continue;
        }
        context.applyClassCache.set(candidate, matches);
    }
    return context.applyClassCache;
}
/**
 * Build a cache only when it's first used
 *
 * @param {() => ApplyCache} buildCacheFn
 * @returns {ApplyCache}
 */ function lazyCache(buildCacheFn) {
    let cache = null;
    return {
        get: (name)=>{
            cache = cache || buildCacheFn();
            return cache.get(name);
        },
        has: (name)=>{
            cache = cache || buildCacheFn();
            return cache.has(name);
        }
    };
}
/**
 * Take a series of multiple caches and merge
 * them so they act like one large cache
 *
 * @param {ApplyCache[]} caches
 * @returns {ApplyCache}
 */ function combineCaches(caches) {
    return {
        get: (name)=>caches.flatMap((cache)=>cache.get(name) || []),
        has: (name)=>caches.some((cache)=>cache.has(name))
    };
}
function extractApplyCandidates(params) {
    let candidates = params.split(/[\s\t\n]+/g);
    if (candidates[candidates.length - 1] === "!important") {
        return [
            candidates.slice(0, -1),
            true
        ];
    }
    return [
        candidates,
        false
    ];
}
function processApply(root, context, localCache) {
    let applyCandidates = new Set();
    // Collect all @apply rules and candidates
    let applies = [];
    root.walkAtRules("apply", (rule)=>{
        let [candidates] = extractApplyCandidates(rule.params);
        for (let util of candidates){
            applyCandidates.add(util);
        }
        applies.push(rule);
    });
    // Start the @apply process if we have rules with @apply in them
    if (applies.length === 0) {
        return;
    }
    // Fill up some caches!
    let applyClassCache = combineCaches([
        localCache,
        buildApplyCache(applyCandidates, context)
    ]);
    /**
   * When we have an apply like this:
   *
   * .abc {
   *    @apply hover:font-bold;
   * }
   *
   * What we essentially will do is resolve to this:
   *
   * .abc {
   *    @apply .hover\:font-bold:hover {
   *      font-weight: 500;
   *    }
   * }
   *
   * Notice that the to-be-applied class is `.hover\:font-bold:hover` and that the utility candidate was `hover:font-bold`.
   * What happens in this function is that we prepend a `.` and escape the candidate.
   * This will result in `.hover\:font-bold`
   * Which means that we can replace `.hover\:font-bold` with `.abc` in `.hover\:font-bold:hover` resulting in `.abc:hover`
   *
   * @param {string} selector
   * @param {string} utilitySelectors
   * @param {string} candidate
   */ function replaceSelector(selector, utilitySelectors, candidate) {
        let selectorList = extractSelectors(selector);
        let utilitySelectorsList = extractSelectors(utilitySelectors);
        let candidateList = extractSelectors(`.${(0, _escapeClassName.default)(candidate)}`);
        let candidateClass = candidateList.nodes[0].nodes[0];
        selectorList.each((sel)=>{
            /** @type {Set<import('postcss-selector-parser').Selector>} */ let replaced = new Set();
            utilitySelectorsList.each((utilitySelector)=>{
                let hasReplaced = false;
                utilitySelector = utilitySelector.clone();
                utilitySelector.walkClasses((node)=>{
                    if (node.value !== candidateClass.value) {
                        return;
                    }
                    // Don't replace multiple instances of the same class
                    // This is theoretically correct but only partially
                    // We'd need to generate every possible permutation of the replacement
                    // For example with `.foo + .foo { … }` and `section { @apply foo; }`
                    // We'd need to generate all of these:
                    // - `.foo + .foo`
                    // - `.foo + section`
                    // - `section + .foo`
                    // - `section + section`
                    if (hasReplaced) {
                        return;
                    }
                    // Since you can only `@apply` class names this is sufficient
                    // We want to replace the matched class name with the selector the user is using
                    // Ex: Replace `.text-blue-500` with `.foo.bar:is(.something-cool)`
                    node.replaceWith(...sel.nodes.map((node)=>node.clone()));
                    // Record that we did something and we want to use this new selector
                    replaced.add(utilitySelector);
                    hasReplaced = true;
                });
            });
            // Sort tag names before class names (but only sort each group (separated by a combinator)
            // separately and not in total)
            // This happens when replacing `.bar` in `.foo.bar` with a tag like `section`
            for (let sel of replaced){
                let groups = [
                    []
                ];
                for (let node of sel.nodes){
                    if (node.type === "combinator") {
                        groups.push(node);
                        groups.push([]);
                    } else {
                        let last = groups[groups.length - 1];
                        last.push(node);
                    }
                }
                sel.nodes = [];
                for (let group of groups){
                    if (Array.isArray(group)) {
                        group.sort((a, b)=>{
                            if (a.type === "tag" && b.type === "class") {
                                return -1;
                            } else if (a.type === "class" && b.type === "tag") {
                                return 1;
                            } else if (a.type === "class" && b.type === "pseudo" && b.value.startsWith("::")) {
                                return -1;
                            } else if (a.type === "pseudo" && a.value.startsWith("::") && b.type === "class") {
                                return 1;
                            }
                            return 0;
                        });
                    }
                    sel.nodes = sel.nodes.concat(group);
                }
            }
            sel.replaceWith(...replaced);
        });
        return selectorList.toString();
    }
    let perParentApplies = new Map();
    // Collect all apply candidates and their rules
    for (let apply of applies){
        let [candidates] = perParentApplies.get(apply.parent) || [
            [],
            apply.source
        ];
        perParentApplies.set(apply.parent, [
            candidates,
            apply.source
        ]);
        let [applyCandidates, important] = extractApplyCandidates(apply.params);
        if (apply.parent.type === "atrule") {
            if (apply.parent.name === "screen") {
                let screenType = apply.parent.params;
                throw apply.error(`@apply is not supported within nested at-rules like @screen. We suggest you write this as @apply ${applyCandidates.map((c)=>`${screenType}:${c}`).join(" ")} instead.`);
            }
            throw apply.error(`@apply is not supported within nested at-rules like @${apply.parent.name}. You can fix this by un-nesting @${apply.parent.name}.`);
        }
        for (let applyCandidate of applyCandidates){
            if ([
                prefix(context, "group"),
                prefix(context, "peer")
            ].includes(applyCandidate)) {
                // TODO: Link to specific documentation page with error code.
                throw apply.error(`@apply should not be used with the '${applyCandidate}' utility`);
            }
            if (!applyClassCache.has(applyCandidate)) {
                throw apply.error(`The \`${applyCandidate}\` class does not exist. If \`${applyCandidate}\` is a custom class, make sure it is defined within a \`@layer\` directive.`);
            }
            let rules = applyClassCache.get(applyCandidate);
            candidates.push([
                applyCandidate,
                important,
                rules
            ]);
        }
    }
    for (let [parent, [candidates, atApplySource]] of perParentApplies){
        let siblings = [];
        for (let [applyCandidate, important, rules] of candidates){
            let potentialApplyCandidates = [
                applyCandidate,
                ...extractBaseCandidates([
                    applyCandidate
                ], context.tailwindConfig.separator)
            ];
            for (let [meta, node] of rules){
                let parentClasses = extractClasses(parent);
                let nodeClasses = extractClasses(node);
                // When we encounter a rule like `.dark .a, .b { … }` we only want to be left with `[.dark, .a]` if the base applyCandidate is `.a` or with `[.b]` if the base applyCandidate is `.b`
                // So we've split them into groups
                nodeClasses = nodeClasses.groups.filter((classList)=>classList.some((className)=>potentialApplyCandidates.includes(className))).flat();
                // Add base utility classes from the @apply node to the list of
                // classes to check whether it intersects and therefore results in a
                // circular dependency or not.
                //
                // E.g.:
                // .foo {
                //   @apply hover:a; // This applies "a" but with a modifier
                // }
                //
                // We only have to do that with base classes of the `node`, not of the `parent`
                // E.g.:
                // .hover\:foo {
                //   @apply bar;
                // }
                // .bar {
                //   @apply foo;
                // }
                //
                // This should not result in a circular dependency because we are
                // just applying `.foo` and the rule above is `.hover\:foo` which is
                // unrelated. However, if we were to apply `hover:foo` then we _did_
                // have to include this one.
                nodeClasses = nodeClasses.concat(extractBaseCandidates(nodeClasses, context.tailwindConfig.separator));
                let intersects = parentClasses.some((selector)=>nodeClasses.includes(selector));
                if (intersects) {
                    throw node.error(`You cannot \`@apply\` the \`${applyCandidate}\` utility here because it creates a circular dependency.`);
                }
                let root = _postcss.default.root({
                    nodes: [
                        node.clone()
                    ]
                });
                // Make sure every node in the entire tree points back at the @apply rule that generated it
                root.walk((node)=>{
                    node.source = atApplySource;
                });
                let canRewriteSelector = node.type !== "atrule" || node.type === "atrule" && node.name !== "keyframes";
                if (canRewriteSelector) {
                    root.walkRules((rule)=>{
                        // Let's imagine you have the following structure:
                        //
                        // .foo {
                        //   @apply bar;
                        // }
                        //
                        // @supports (a: b) {
                        //   .bar {
                        //     color: blue
                        //   }
                        //
                        //   .something-unrelated {}
                        // }
                        //
                        // In this case we want to apply `.bar` but it happens to be in
                        // an atrule node. We clone that node instead of the nested one
                        // because we still want that @supports rule to be there once we
                        // applied everything.
                        //
                        // However it happens to be that the `.something-unrelated` is
                        // also in that same shared @supports atrule. This is not good,
                        // and this should not be there. The good part is that this is
                        // a clone already and it can be safely removed. The question is
                        // how do we know we can remove it. Basically what we can do is
                        // match it against the applyCandidate that you want to apply. If
                        // it doesn't match the we can safely delete it.
                        //
                        // If we didn't do this, then the `replaceSelector` function
                        // would have replaced this with something that didn't exist and
                        // therefore it removed the selector altogether. In this specific
                        // case it would result in `{}` instead of `.something-unrelated {}`
                        if (!extractClasses(rule).some((candidate)=>candidate === applyCandidate)) {
                            rule.remove();
                            return;
                        }
                        // Strip the important selector from the parent selector if at the beginning
                        let importantSelector = typeof context.tailwindConfig.important === "string" ? context.tailwindConfig.important : null;
                        // We only want to move the "important" selector if this is a Tailwind-generated utility
                        // We do *not* want to do this for user CSS that happens to be structured the same
                        let isGenerated = parent.raws.tailwind !== undefined;
                        let parentSelector = isGenerated && importantSelector && parent.selector.indexOf(importantSelector) === 0 ? parent.selector.slice(importantSelector.length) : parent.selector;
                        rule.selector = replaceSelector(parentSelector, rule.selector, applyCandidate);
                        // And then re-add it if it was removed
                        if (importantSelector && parentSelector !== parent.selector) {
                            rule.selector = (0, _applyImportantSelector.applyImportantSelector)(rule.selector, importantSelector);
                        }
                        rule.walkDecls((d)=>{
                            d.important = meta.important || important;
                        });
                        // Move pseudo elements to the end of the selector (if necessary)
                        let selector = (0, _postcssselectorparser.default)().astSync(rule.selector);
                        selector.each((sel)=>(0, _pseudoElements.movePseudos)(sel));
                        rule.selector = selector.toString();
                    });
                }
                // It could be that the node we were inserted was removed because the class didn't match
                // If that was the *only* rule in the parent, then we have nothing add so we skip it
                if (!root.nodes[0]) {
                    continue;
                }
                // Insert it
                siblings.push([
                    meta.sort,
                    root.nodes[0]
                ]);
            }
        }
        // Inject the rules, sorted, correctly
        let nodes = context.offsets.sort(siblings).map((s)=>s[1]);
        // `parent` refers to the node at `.abc` in: .abc { @apply mt-2 }
        parent.after(nodes);
    }
    for (let apply of applies){
        // If there are left-over declarations, just remove the @apply
        if (apply.parent.nodes.length > 1) {
            apply.remove();
        } else {
            // The node is empty, drop the full node
            apply.parent.remove();
        }
    }
    // Do it again, in case we have other `@apply` rules
    processApply(root, context, localCache);
}
function expandApplyAtRules(context) {
    return (root)=>{
        // Build a cache of the user's CSS so we can use it to resolve classes used by @apply
        let localCache = lazyCache(()=>buildLocalApplyCache(root, context));
        processApply(root, context, localCache);
    };
}
