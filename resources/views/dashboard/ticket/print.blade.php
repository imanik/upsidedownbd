<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ 'Ticket-' . $ticket->reference . ' ' . config('app.name', 'Laravel') }}</title>
    <!-- icon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Styles -->
    <style>
        html, body {
            font-family: arial, sans-serif;
        }
        .w-full {
            width: 100%;
        }
        .collapse {
            border-collapse: collapse;
        }
        .border {
            /* border: 3px solid black; */
        }
        .no-border {
            border: 0;
        }
    </style>
</head>

<body style="background-image: url('{{ public_path('img/background-ticket.jpg') }}'); background-repeat: no-repeat;">
    <div class="flex flex-col h-screen">
        <div id="app" class="py-8 px-4 sm:px-6 lg:px-8 flex-1">
            <div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">

                <section class="text-gray-600 body-font">
                    <div class="container mx-auto flex flex-wrap">
                        <div class="lg:w-2/3 mx-auto">

                            <table class="collapse w-full border no-border" style="margin-bottom: 22px;" height="300">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center; height: 60px;">
                                            <h1 style="color: white;">{{ __('Ticket Information') }}</h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; height: 80px;">
                                            <p style="font-size: 22px; font-weight: bold; text-align: center;"> {{ $branch->name }} Branch </p>
                                            <p style="font-size: 18px; font-weight: normal; text-align: center;"> {{ $branch->address }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="w-full border" style="font-size: 15px;">
                                <tr>
                                    <td class="border" colspan="2" style="text-align: center; height: 16px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="2" style="text-align: center; height: 40px;">
                                        <p style=" color: white; font-size: 24px; text-transform: uppercase"> {{ __('Reference : ')}} <b>{{ $ticket->reference }}</b></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border" style="text-align: right; font-weight: bold; width: 35%; padding-right: 25px; height: 56px;">Visit Date</td>
                                    <td class="border">
                                        <span>{{ date('d/m/Y', strtotime($ticket->date)) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border" style="text-align: right; font-weight: bold; width: 35%; padding-right: 25px; height: 80px;">Branch</td>
                                    <td class="border">
                                        <span class="text-base font-semibold"><span>{{ $ticket->branch->name }}</span></span> <br>
                                        <span class="font-normal">{{ $ticket->slots->count() > 0 ? optional($ticket->slots[0]->slot)->name : "N/A" }}</span> @if($ticket->slots->count() > 1) - <span class="font-normal">{{ $ticket->slots[$ticket->slots->count() - 1]->slot->name }}</span> @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border" style="text-align: right; font-weight: bold; width: 35%; padding-right: 25px; height: 100px;">Customer</td>
                                    <td class="border" style=" height: 100px; overflow: hidden;">
                                        <span class="text-base font-semibold">{{ optional($ticket->customer)->name }}</span> <br>
                                        <span class="text-sm">{{ optional($ticket->customer)->mobile }}</span> <br>
                                        <span class="text-sm">{{ optional($ticket->customer)->email }}</span> <br>
                                        <span class="text-sm">{{ Str::limit(optional($ticket->customer)->address, 70, ' (...)') }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border" style="text-align: right; font-weight: bold; width: 35%; padding-right: 25px; height: 76px;">Ticket</td>
                                    <td class="border">
                                        @if($ticket->regular_ticket_count > 0)
                                        <span class="text-sm font-semibold" x-show="data.no_of_adult > 0">Adult: <span class="font-normal">{{ $ticket->regular_ticket_count }}</span></span> <br>
                                        @endif
                                        @if($ticket->child_ticket_count > 0)
                                        <span class="text-sm font-semibold" x-show="data.no_of_child > 0">Child: <span class="font-normal">{{ $ticket->child_ticket_count }}</span></span><br>
                                        @endif
                                        @if($ticket->facility)
                                        <span class="text-sm" x-html="data.facility_text">{{ $ticket->facility->title }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border" style="text-align: right; font-weight: bold; width: 35%; padding-right: 25px; height: 46px;">Amount</td>
                                    <td class="border">
                                        <span>{{ $ticket->grand_total }} Tk</span>
                                        <span>{{ $ticket->coupon? '(Coupon: ' . $ticket->coupon->code . ')' : '' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border" style="text-align: right; font-weight: bold; width: 35%; padding-right: 25px; height: 46px;">Payment Status</td>
                                    <td class="border">
                                        <span class="text-base font-semibold">{{ App\Helpers::asText($ticket->payment_status) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border" style="text-align: right; font-weight: bold; width: 35%; padding-right: 25px; height: 50px;">Created At</td>
                                    <td class="border">
                                        <span class="text-base font-semibold">{{ $ticket->getCreatedAt() }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
