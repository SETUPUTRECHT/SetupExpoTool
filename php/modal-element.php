<div class="modal fade" id="dialog-new">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>Expo element</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="pieceTitle">Name of piece</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="pieceTitle">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="new-src">URL</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="new-src">
						<p class="help-block">
							<a href="#" class="tltip" rel="tooltip" data-original-title="Copy the Youtube URL. Example: http://www.youtube.com/watch?v=yNeF30RverQ">Youtube</a> and <a href="#" class="tltip" rel="tooltip" data-original-title="Copy the Vimeo url. example: http://vimeo.com/40117938">Vimeo</a> url's
							<br />
							and .gif, .jpg en .png images are allowed.
						</p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="pieceDesc">Description:</label>
					<div class="controls">
						<textarea class="input-xlarge" id="pieceDesc"  rows="3"></textarea>
					</div>
				</div>
	</div>
	<div class="modal-footer">
		<!-- 	<div class="form-actions"> -->
		<a href="#" class="btn btn-primary" id="submitPiece">
			Save
		</a>
		<a href="#" class="btn btn-primary" id="changePiece" style="display: none;">
			Save changes
		</a>
		<a href="#" class="btn btn-danger" id="deletePiece" style="display: none;">
			Delete
		</a>
		<a href="#" class="btn" data-toggle="modal" data-target="#dialog-new">
			Cancel
		</a>
		<!-- 						</div> -->
		</fieldset>
		</form>
	</div>
</div>
