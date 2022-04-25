<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="{{public_path('css/custom_pdf.css')}}">
    <link rel="stylesheet" href="{{public_path('css/custom_page.css')}}">

</head>
<body>
    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-center">
                    <span style="font-size: 25px; font-weight: bold; color: #9F150D">
                        YOR System
                    </span>
                </td>
            </tr>
            <tr>
                <td width="40%" style="vertical-align: top; position: relative;">
                    <img src="{{public_path('assets/img/Yor.Briar.logo.jpg')}}" alt="Logo" class="invoice-logo">
                </td>
                <td width="60%" class="text-left text-company" style="vertical-align: top; padding-top: 50px; margin-left: -50px">
                    @if ($reportType == 0)
                        <span style="font-size: 16px"><strong>Reporte de ventas del día</strong> </span>
                    @else
                        <span style="font-size: 16px"><strong>Reporte de ventas por fecha</strong></span>
                    @endif
                    <br>
                    @if ($reportType !=0)
                         <span style="font-size: 16px"><strong>Fecha de Consulta: {{$dateFrom}} al {{$dateTo}}</strong></span>
                    @else
                        <span style="font-size: 16px"><strong>Fecha de Consulta: {{\Carbon\Carbon::now()->format('d-M-Y')}}</strong></span>
                    @endif
                    <br>
                    <span style="font-size: 14px"><strong>Usuario: {{$user}}</strong></span>

                </td>
            </tr>
        </table>
    </section>

    <section style="margin-top: -30px">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th width="10%">Id</th>
                    <th width="12%">Importe</th>
                    <th width="10%">Items</th>
                    <th width="12%">Estatus</th>
                    <th>Usuario</th>
                    <th width="18%">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td align="center">{{$item->id}}</td>
                        <td align="center">{{number_format($item->total,2)}}</td>
                        <td align="center">{{$item->items}}</td>
                        <td align="center">{{$item->status}}</td>
                        <td align="center">{{$item->user}}</td>
                        <td align="center">{{$item->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center">
                        <b>Totales: </b>
                    </td>
                    <td class="text-center" colspan="1">
                        <span><strong>S/. {{number_format($data->sum('total'),2)}}</strong></span>
                    </td>
                    <td class="text-center">
                        {{$data->sum('items')}}
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </section>

    <section class="footer">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <tr>
                <td width="20%">
                    <span>YOR System Versión 2</span>
                </td>
                <td width="60%">

                </td>
                <td width="20%">
                    Página <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </section>
</body>
</html>
