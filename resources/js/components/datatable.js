"use strict";

require("datatables.net-dt");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

(function (factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery", "moment", "datatables.net"], factory);
    } else {
        factory(jQuery, moment);
    }
}(function ($, moment) {

    function strip (d) {
        if ( typeof d === 'string' ) {
            // Strip HTML tags and newline characters if possible
            d = d.replace(/(<.*?>)|(\r?\n|\r)/g, '');

            // Strip out surrounding white space
            d = d.trim();
        }

        return d;
    }

    $.fn.dataTable.moment = function ( format, locale, reverseEmpties ) {
        var types = $.fn.dataTable.ext.type;

        // Add type detection
        types.detect.unshift( function ( d ) {
            d = strip(d);

            // Null and empty values are acceptable
            if ( d === '' || d === null ) {
                return 'moment-'+format;
            }

            return moment( d, format, locale, true ).isValid() ?
                'moment-'+format :
                null;
        } );

        // Add sorting method - use an integer for the sorting
        types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
            d = strip(d);

            return !moment(d, format, locale, true).isValid() ?
                (reverseEmpties ? -Infinity : Infinity) :
                parseInt( moment( d, format, locale, true ).format( 'x' ), 10 );
        };
    };

}));


$.fn.dataTable.moment( 'DD/MM/YYYY' );

$('table[id^="table"]').DataTable({
    lengthMenu: [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
    length: 10,
    dom: "<'flex justify-center sm:justify-end mb-3'B><'flex flex-col sm:flex-row justify-between'lf><'block overflow-auto'rt><'flex flex-col sm:flex-row justify-between'ip>",
    buttons: [
        'excel', 'pdf', 'print'
    ]
});
