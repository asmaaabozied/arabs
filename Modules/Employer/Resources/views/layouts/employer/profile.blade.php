@extends('dashboard::layouts.employer.master')
@section('content')
<h1 style="color:#4E4187">Profile </h1>
<div class="container-fluid">


    <div class="row">
        <div class="col-xl-1 col-md-3 mb-4">
            <a class="img logo rounded-circle mb-5" href="#"><img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="hugenerd" width="100" height="100" class="rounded-circle"></a>
        </div>

        <div class="col-md-3 col-md-3">
            <h2>Employer Name</h2>
            <span class="mr-4">Membership levels</span>
        </div>
        <div class="col-md-3 col-md-3"></div>

        <div class="col-md-5 col-md-3">
            <div class="form-inline">
                    <h2 class="pl-4">Status <button class="btn btn-primary m-2">Active</button></h2>

        </div>

        </div>

    </div>

    <h3>Personal Info</h3>
    <div class="row">
        <table class="table ">
                <thead>
                    <tr>
                        <th>UserName</th>
                        <td >aminul12345</td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td>Aminul Islam</td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td>user@email.com</td>
                    </tr>
                    <tr>
                        <th> Phone</th>
                        <td> +0123456789</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>Male</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>Lorem Ipsum is simply dummy text of the printing</td>
                    </tr>
                    <tr>
                        <th>Zip Code</th>
                        <td>123456</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>Lorem Ipsum</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>Lorem Ipsum</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>Canada</td>
                    </tr>
                    <tr>
                        <th> About</th>
                        <td> Lorem Ipsum</td>
                    </tr>
                    <tr>
                        <th> Date of Join </th>
                        <td> 12-10-2022</td>
                    </tr>

                    <tr>
                        <th> Verify Email Status </th>
                        <td> Yes </td>
                    </tr>
                    <tr>
                        <th> Verify Phone Status </th>
                        <td> No </td>
                    </tr>
                    <tr>
                        <th>Wallet Balance</th>
                        <td> 0 $</td>
                    </tr>
                    <tr>
                        <th>Total Spends</th>
                        <td> 0 $</td>
                    </tr>
                    <tr>
                        <th>Count Of Privileges</th>
                        <td> 0 </td>
                    </tr>
                    <tr>
                        <th>Count Of Suspend Days</th>
                        <td> 0</td>
                    </tr>
                </thead>

        </table>

    </div>


    <div class="card shadow mb-4" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">المهمات</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>تفاصيل المهمة</th>
                            <th>حالة المهمة</th>
                            <th>عدد العمل</th>
                            <th>تكلفة المهمة</th>
                            <th> تاريخ انتهاء</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>تفاصيل المهمة</th>
                            <th>حالة المهمة</th>
                            <th>عدد العمل</th>
                            <th>تكلفة المهمة</th>
                            <th> تاريخ انتهاء</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>fsafsadf</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>

                            <td><i class="p-1 fa fa-facebook-square" style="font-size:36px; color:blue" aria-hidden="true"></i> 864f86sa789789789</td>
                            <td><a href="#" class="btn btn-success btn-icon-split"  >
                                <span align="center" class="text">نشط منذ شهر</span></a>
                            </td>
                            <td>66</td>
                            <td>$86,000</td>
                            <td>2009/01/12</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
                        </tr>   <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
                        </tr>   <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
                        </tr>   <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

