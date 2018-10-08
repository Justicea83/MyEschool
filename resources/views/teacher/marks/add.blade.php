@extends('teacher.index')

@push('css')

@endpush


@section('title','Student')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-address-card"></i>ADD MARKS</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-lg-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-search"></i>MAKE SELECTION</h6>
                            <div class="inner-item dash-search-form">
                                <div class="col-md-3 col-sm-6">
                                    <label>CLASS</label>
                                    <select>
                                        <option>5th STD</option>
                                        <option>6th STD</option>
                                        <option>7th STD</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label>SECTION</label>
                                    <select>
                                        <option>PTH05A</option>
                                        <option>PTH05B</option>
                                        <option>PTH06A</option>
                                        <option>PTH06B</option>
                                    </select>
                                </div>
                                <div class="clearfix visible-sm"></div>
                                <div class="col-md-3 col-sm-6">
                                    <label>COURSE CODE</label>
                                    <select>
                                        <option>MTH101</option>
                                        <option>MTH102</option>
                                        <option>MTH103</option>
                                        <option>MTH104</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label>MARKS TYPE</label>
                                    <select>
                                        <option>Class Assessment</option>
                                        <option>Mid Term</option>
                                        <option>End Term</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-3">
                                    <button type="submit" class="submit-btn"><i class="fa fa-search"></i>SELECT</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-info-circle"></i>ADD MARKS</h6>
                            <div class="inner-item">
                                <table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-puzzle-piece"></i>ROLL #</th>
                                        <th><i class="fa fa-user"></i>NAME</th>
                                        <th><i class="fa fa-code"></i>SUBJECT</th>
                                        <th><i class="fa fa-cogs"></i>TYPE</th>
                                        <th><i class="fa fa-address-card"></i>MARKS OBTAINED</th>
                                        <th><i class="fa fa-address-card"></i>MAX MARKS</th>
                                        <th><i class="fa fa-edit"></i>REMARKS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>PTH050A01</td>
                                        <td>John Doe</td>
                                        <td>MTH101</td>
                                        <td>
                                            Mid Term
                                        </td>
                                        <td><input type="text" placeholder="Marks Obtained" class="datatable-input"/></td>
                                        <td><input type="text" placeholder="Max Marks" class="datatable-input"/></td>
                                        <td><input type="text" placeholder="Remarks" class="datatable-input"/></td>
                                    </tr>
                                    <tr>
                                        <td>PTH050A02</td>
                                        <td>Lennore Doe</td>
                                        <td>MTH101</td>
                                        <td>
                                            Mid Term
                                        </td>
                                        <td><input type="text" placeholder="Marks Obtained" class="datatable-input"/></td>
                                        <td><input type="text" placeholder="Max Marks" class="datatable-input"/></td>
                                        <td><input type="text" placeholder="Remarks" class="datatable-input"/></td>
                                    </tr>
                                    <tr>
                                        <td>PTH050A03</td>
                                        <td>John Doe</td>
                                        <td>MTH101</td>
                                        <td>
                                            Mid Term
                                        </td>
                                        <td><input type="text" placeholder="Marks Obtained" class="datatable-input"/></td>
                                        <td><input type="text" placeholder="Max Marks" class="datatable-input"/></td>
                                        <td><input type="text" placeholder="Remarks" class="datatable-input"/></td>
                                    </tr>
                                    <tr>
                                        <td>PTH050A04</td>
                                        <td>Lennore Doe</td>
                                        <td>MTH101</td>
                                        <td>
                                            Mid Term
                                        </td>
                                        <td><input type="text" placeholder="Marks Obtained" class="datatable-input"/></td>
                                        <td><input type="text" placeholder="Max Marks" class="datatable-input"/></td>
                                        <td><input type="text" placeholder="Remarks" class="datatable-input"/></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="table-action-box">
                                    <a href="#" class="save"><i class="fa fa-check"></i>SAVE</a>
                                    <a href="#" class="cancel"><i class="fa fa-ban"></i>CANCEL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-togggle-btn">
            <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
        @include('admin.partials.footer')
    </div>
@endsection


@push('scripts')

@endpush