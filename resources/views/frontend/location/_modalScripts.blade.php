@push('scripts')
<script>
    var locations;
    $(function($){
        $('button.location').click(function(ev){
            if(!locations) {
                locations = $.getJSON("{!! route('frontend.locations.search.all') !!}");
            }
            ev.preventDefault();
            var uid = $(this).data('id');
            $.get('/samples/' + uid + '/edit/location', function(html){
                $('#dynModal .modal-content').html(html);
                $('#dynModal').modal('show', {backdrop: 'static'});
                $("#location\\[name\\]")
                        .select2({
                            data: locations.responseJSON.items
                        });
            });
        });
    });
</script>
@endpush
