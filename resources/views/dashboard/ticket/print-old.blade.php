<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- icon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Styles -->
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        table.no-border td {
            border: 0px;
        }
        table.no-border tr:nth-child(even) {
            background-color: transparent;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex flex-col h-screen">
        <div id="app" class="py-8 px-4 sm:px-6 lg:px-8 flex-1">
            <div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">

                <section class="text-gray-600 body-font">
                    <form class="container mx-auto flex flex-wrap" action="{{ route('pay') }}" method="Post">
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        @csrf
                        <div class="lg:w-2/3 mx-auto">
                            @include('partials.alert')
                            <table class="no-border">
                                <tbody>
                                    <tr>
                                        <td rowspan="2">
                                            <img class="" src="{{ public_path('img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} logo">
                                        </td>
                                        <td>
                                            <h2 class="text-3xl text-center text-yellow-500 font-medium my-2"> {{ $branch->name }} Branch</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="flex justify-center items-start leading-relaxed">
                                                <svg class="svg-icon" viewBox="0 0 20 20">
                                                    <path d="M10,1.375c-3.17,0-5.75,2.548-5.75,5.682c0,6.685,5.259,11.276,5.483,11.469c0.152,0.132,0.382,0.132,0.534,0c0.224-0.193,5.481-4.784,5.483-11.469C15.75,3.923,13.171,1.375,10,1.375 M10,17.653c-1.064-1.024-4.929-5.127-4.929-10.596c0-2.68,2.212-4.861,4.929-4.861s4.929,2.181,4.929,4.861C14.927,12.518,11.063,16.627,10,17.653 M10,3.839c-1.815,0-3.286,1.47-3.286,3.286s1.47,3.286,3.286,3.286s3.286-1.47,3.286-3.286S11.815,3.839,10,3.839 M10,9.589c-1.359,0-2.464-1.105-2.464-2.464S8.641,4.661,10,4.661s2.464,1.105,2.464,2.464S11.359,9.589,10,9.589"></path>
                                                </svg>
                                                {{ $branch->address }}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <hr class="my-4">

                            <div>
                                <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-900 text-center" style="text-align: center">
                                        {{ __('Ticket Information') }}
                                    </h3>
                                    <p class="mt-1 mx-auto max-w-2xl text-base text-gray-600 text-center" style="text-align: center"> {{ __('Reference: ')}} <b>{{ $ticket->reference }}</b></p>
                                </div>
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:items-start">
                                        <div class="mt-10 sm:mt-0">
                                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                                <div class="mt-5 md:mt-0 md:col-span-3">
                                                    <div class="overflow-hidden sm:rounded-lg">
                                                        <table>
                                                            <tr>
                                                                <td>Visit Date</td>
                                                                <td>
                                                                    <span>{{ date('d/m/Y', strtotime($ticket->date)) }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Branch</td>
                                                                <td>
                                                                    <span class="text-base font-semibold"><span>{{ $ticket->branch->name }}</span></span> <br>
                                                                    @foreach($ticket->slots as $ticket_slot)
                                                                    <span class="text-sm font-semibold">
                                                                        Slot: <span class="font-normal">{{ optional($ticket_slot->slot)->name }}</span> <br>
                                                                    </span>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Customer</td>
                                                                <td>
                                                                    <span class="text-base font-semibold">{{ optional($ticket->customer)->name }}</span> <br>
                                                                    <span class="text-sm">{{ optional($ticket->customer)->mobile }}</span> <br>
                                                                    <span class="text-sm">{{ optional($ticket->customer)->email }}</span> <br>
                                                                    <span class="text-sm">{{ optional($ticket->customer)->address }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ticket</td>
                                                                <td>
                                                                    <span class="text-sm font-semibold" x-show="data.no_of_adult > 0">Adult: <span class="font-normal">{{ $ticket->regular_ticket_count }}</span></span> <br>
                                                                    <span class="text-sm font-semibold" x-show="data.no_of_child > 0">Child: <span class="font-normal">{{ $ticket->child_ticket_count }}</span></span><br>
                                                                    <span class="text-sm" x-html="data.facility_text">{{ $ticket->facility? $ticket->facility->title : '' }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Amount</td>
                                                                <td>
                                                                    <span>{{ $ticket->grand_total }} Tk</span>
                                                                    <span>{{ $ticket->coupon? '(Coupon: ' . $ticket->coupon->code . ')' : '' }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Payment Status</td>
                                                                <td>
                                                                    <span class="text-base font-semibold">{{ App\Helpers::asText($ticket->payment_status) }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Created At</td>
                                                                <td>
                                                                    <span class="text-base font-semibold">{{ $ticket->getCreatedAt() }}</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
