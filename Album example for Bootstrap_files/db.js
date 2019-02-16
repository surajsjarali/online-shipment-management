 <script type="text/javascript">
    
      $(document).ready(function(){
        $('#').click(function(){
          var $prodview = $(this).parent().parent().next();
          $($prodview).fadeIN('1000');
        });
        $('.close-btn').click(function(){
          var $closebtn = $(this).parent();
          $($closebtn).fadeOut('800');
        });
        });
    </script>