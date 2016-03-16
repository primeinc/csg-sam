@push('scripts')
<script>
    $(function($){
        $('button.location').click(function(ev){
            ev.preventDefault();
            var uid = $(this).data('id');
            $.get('/samples/' + uid + '/edit/location', function(html){
                $.getJSON("{!! route('api.get.all', 'locations') !!}", function(data) {
                    $('#dynModal .modal-content').html(html);
                    $('#dynModal').modal('show', {backdrop: 'static'});
                    $("#location\\[name\\]")
                            .select2({
                                data: data.items
                            });
                });
            });
        });
    });
</script>
@endpush
