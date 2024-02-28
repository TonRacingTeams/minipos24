<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>

     <!-- Core CSS -->
     <link rel="stylesheet" href="{{ url ('assets/vendor/css/core.css')}}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ url ('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ url ('assets/css/demo.css')}}">
    <link rel="stylesheet" href="{{ url ('assets/css/font_lao.css')}}">


</head>
<body style="background-color: white;">
<!--{{ $bill }}
<hr>
{{ $bill_list }}-->


<div class="container text-center" style="width: 794px;">
<p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
<p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ</p>

<h2 class="mt-4">ໃບບີນຮັບເງີນ</h2>

<div class="d-flex justify-content-end">
    <span>ໃບບີນເລກທີ : {{ $bill[0]['bill_id']}}</span>
</div>

<div class="text-strat">
    @if($bill[0]['customer_name']=='')

    ລູກຄ້າ : ລູກຄ້າທົ່ວໄປ

    @else

    ລູກຄ້າ : {{ $bill[0]['customer_name']}}, {{ $bill[0]['customer_tel']}}

    @endif

</div>

<table>
    <thead>
    <th width= "80">ລ/ດ</th>
    <th class= "text-start 300">ລາຍການ</th>
    <th width= "150">ລາຄາ</th>
    <th width= "60">ຈຳນວນ</th>
    <th width= "200">ລວມ</th>
    </thead>

    <tbody>
        @php($num=1)
        @php($total=0)
        @foreach($bill_list as $b)

        <tr>
            <td>{{$num++}}</td>
            <td>{{$b['name']}}</td>
            <td>{{number_format($b['price'],0,',','.')}}</td>
            <td>{{$b['amount']}}</td>
            <td>{{number_format($b['price']*$b['amount'],0,',','.')}}</td>
            @php($total += $b['price']*$b['amount'])
        </tr>
        @endforeach

        <tr>
            <td colspan="4"> ລວມທັງໝົດ :</td>
            <td class="text-end">{{ number_format($total,0,',','.')}}</td>
        </tr>
    </tbody>
</table>

<div class="d-flex justify-content-between p-4"></div>

<span>ພະນັກງານ</span>
<span>ຜູ້ຈ່າຍເງີນ</span>

</div>
    
</body>
</html>