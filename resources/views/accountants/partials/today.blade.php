<table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th><i class="fa fa-book"></i>STUDENT</th>
        <th><i class="fa fa-code"></i>CLASS</th>
        <th><i class="fa fa-user-secret"></i>ACCOUNTANT</th>
        <th><i class="fa fa-info-circle"></i>PAYMENT MODE</th>
        <th><i class="fa fa-info-circle"></i>AMOUNT PAID</th>
        <th><i class="fa fa-info-circle"></i>AMOUNT PAYABLE</th>
        <th><i class="fa fa-sliders"></i>BALANCE</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($today as $item)
    <tr>
        <td class="text-center">{{$item->fname}} {{$item->mname}} {{$item->lname}}</td>
        <td class="text-center">{{$item->name}}</td>
        <td class="text-center">{{$item->accountant}}</td>
        <td class="text-center">
                <span class="label {{$item->payment_mode == 'cash' ? 'label-primary':'label-success'}}">
                    {{$item->payment_mode}}
                </span>
        </td>
        <td class="text-center"><strong>{{number_format($item->amount,2)}}</strong></td>
        <td class="text-center"><strong>{{number_format($item->amount_payable,2)}}</strong></td>
        <td class="text-center"><strong>{{number_format($item->balance,2)}}</strong></td>
        <td>
            <a href="{{route('transactions.show',['id'=>$item->id])}}" class="btn btn-primary btn-sm">
                <span class="fa fa-eye"></span>
            </a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>