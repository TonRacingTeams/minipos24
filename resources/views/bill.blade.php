<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.</title>

     <!-- Core CSS -->
     <link rel="stylesheet" href="{{ url ('assets/vendor/css/core.css')}}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ url ('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ url ('assets/css/demo.css')}}">
    <link rel="stylesheet" href="{{ url ('assets/css/font_lao.css')}}">


</head>
<body style="background-color: white; ">
<!--{{ $bill }}
<hr>
{{ $bill_list }}-->


<div class="container text-center mt-10" style="width: 1000px; color: black;">
<p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</p>
<p>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ</p>

<h2 class="mt-4" style="color: black;">ໃບບີນຮັບເງີນ</h2>

<div class="d-flex justify-content-end">
    <span>ໃບບີນເລກທີ : {{ $bill[0]['bill_id']}}</span>
</div>

<div class="d-flex justify-content-start mb-1">
    @if($bill[0]['customer_name']=='')

    ລູກຄ້າ : ລູກຄ້າທົ່ວໄປ

    @else

    ລູກຄ້າ : {{ $bill[0]['customer_name']}}, ເບີໂທ : {{ $bill[0]['customer_tel']}}

    @endif

</div>

<table class="table table-bordered">
    <thead >
    
    <th class= "80" style="color: black;">ລ/ດ</th>
    <th class= "text-center 1200" style="color: black;">ລາຍການ</th>
    <th class= "text-center 150" style="color: black;">ລາຄາ</th>
    <th class= "text-center 60" style="color: black;">ຈຳນວນ</th>
    <th class= "text-center 200" style="color: black;">ລວມ</th>
    </thead>

    <tbody>
        @php($num=1)
        @php($total=0)
        @foreach($bill_list as $b)

        <tr>
            <td style="color: black;">{{$num++}}</td>
            <td style="color: black;">{{$b['name']}}</td>
            <td class="text-end" style="color: black;">{{number_format($b['price'],0,',','.')}}</td>
            <td style="color: black;">{{$b['amount']}}</td>
            <td class="text-end" style="color: black;">{{number_format($b['price']*$b['amount'],0,',','.')}}</td>
            @php($total += $b['price']*$b['amount'])
        </tr>
        @endforeach

        <tr>
            <td colspan="4" style="color: black;"> ລວມທັງໝົດ :</td>
            <td class="text-end" style="color: red;">{{ number_format($total,0,',','.')}}</td>
        </tr>
    </tbody>
</table>

<div class="d-flex justify-content-between p-4">

<span>ພະນັກງານ</span>
<span>ຜູ້ຈ່າຍເງີນ</span>

</div>
</div>

<script>
    window.print();
    setTimeout('window.close();', 3000);
</script>
    
</body>
</html>