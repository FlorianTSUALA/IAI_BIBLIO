<script type="text/javascript">

  $('#basic').on('itemAddedOnInit', function(event) {
    // event.item: contains the item
  });
      console.log($("#basic").tagsinput('items'))

  $('#basic').on('itemAdded', function(event) {
    // event.item: contains the item
      console.log($("#basic").tagsinput('items'))
  });

  $('#basic').on('itemRemoved', function(event) {
      console.log($("#basic").tagsinput('items'))
    // event.item: contains the item
  });

</script>