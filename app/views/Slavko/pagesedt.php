    <main role="main" class="container">
	<p class="h1 text-center">Редактирование страниц</p>
	<hr>
	<div class="row">
		<div class="col-sm-12">
                    <form method="post" action="\slavko\savelogs">
                    <div class="form-group">
			<label for="txtedt">Область редактирования содержимого</label>
			<textarea class="form-control" 
				  id="txtedt" 
				  name="txtedt"
				  rows="45">
                        <?php echo $pcontent?>    
			</textarea>
                    </div>
                        <input type="hidden" id="fname" name="fname" value="<?php echo $fname; ?>">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
			
		</div>
	</div>
     
           <script>
               CKEDITOR.replace( 'txtedt' );
            </script>
    </main>