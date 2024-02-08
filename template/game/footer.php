
            <?php
            if(!empty($errormsg)){
                echo '
                            <br />
                            <div class="alert alert-danger" role="alert">
                                  '.$errormsg.'
                            </div>
                        ';
            }
            ?>

            <?php
            if(!empty($infomsg)){
                echo '
                            <br />
                            <div class="alert alert-warning" role="alert">
                                  '.$infomsg.'
                            </div>
                        ';
            }
            ?>
          </div>
      </div>
    </div>
</div>

</body>
</html>