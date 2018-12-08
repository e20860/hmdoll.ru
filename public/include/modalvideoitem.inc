       <!--        модальное окно -->
	<div class="modal" id="videoModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Видео куклы</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body text-center">
			<video width="400" height="300" autoplay="autoplay" loop="loop" controls="controls" >
				<source src="<?php echo '../video/' . $video?>" type="video/mp4" />
			</video>
		  </div>
		  <div class="modal-footer">
		  </div>
		</div>
	  </div>
	</div>	
        <!-- конец модального окна -->

