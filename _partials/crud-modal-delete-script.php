
<script>
    $('#confirm-delete').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        var id = $(this).data('recordId');
        // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
        $modalDiv.addClass('loading');
        $.get('<?= URL::link("$model-controller");?>?id=' + id).then(
            window.location.href = '<?= URL::link("$model");?>#form'
        )
        
        setTimeout(function() {
            $modalDiv.modal('hide').removeClass('loading');
            window.location.href = '<?= URL::link("$model");?>#form'
        }, 1000)
    });
    $('#confirm-delete').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('.title', this).text(data.recordTitle);
        $('.btn-ok', this).data('recordId', data.recordId);
    });
</script>
