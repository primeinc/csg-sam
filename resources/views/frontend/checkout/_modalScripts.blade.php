@push('scripts')
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
    $.fn.select2.defaults.set( "theme", "bootstrap" );
    $.fn.select2.defaults.set( "width", "off" );
    var reps;
    $(function($){
        $("#dynModal").on("shown.bs.modal", function () {
            if(!reps) {
                reps = $.getJSON("{!! route('frontend.user.search.all') !!}");
            }
            $('input[name="daterange"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                startDate: "{{ Carbon\Carbon::now()->addDays(14)->format('m/d/Y') }}"
            });
            $("#checkout-dealer").select2({
                        placeholder: "Select a Dealer",
                        ajax: {
                            url: "{!! route('frontend.dealers.search') !!}",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function (data, params) {
                                params.page = params.page || 1;

                                return {
                                    results: data.items,
                                    pagination: {
                                        more: (params.page * 30) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 1
                    })
                    .on('change', function(e) {
                        item = $(this).select2('data');
                        $("#checkout-rep")
                                .empty()
                                .append($('<option>', {value: item[0].user_id, selected: "selected"})
                                        .text(item[0].user_name))
                                .select2({
                                    data: reps.responseJSON.items
                                });

                    });
        });

        $('button.checkout').click(function(ev){
            ev.preventDefault();
            var uid = $(this).data('id');
            $.get('/samples/checkout/' + uid, function(html){
                $('#dynModal .modal-content').html(html);
                $('#dynModal').modal('show', {backdrop: 'static'});
            });
        });

        $('button.checkin').click(function(ev){
            ev.preventDefault();
            var uid = $(this).data('id');
            $.get('/samples/checkin/' + uid, function(html){
                $('#dynModal .modal-content').html(html);
                $('#dynModal').modal('show', {backdrop: 'static'});
            });
        });


    });
</script>
@endpush