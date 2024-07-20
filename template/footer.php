            <script type="text/javascript">
                $("#alert1").on('click', function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 1);
                });
                
                $("#alert2").on('click', function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 1);
                });
            </script>
        </div>
    </div>
   
  </body>
</html>