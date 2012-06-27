<div class="modal fade" id="expo-props">
	<div class="modal-header">
		<a id="closeExpo" class="close" data-dismiss="modal">×</a>
		<h3>New expo</h3>
	</div>
	<div class="modal-body">
	
		<form class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="name">Name expo</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="name" name="name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="name">Name curators</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="nameCurator" name="nameCurator">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="emailCurator">E-mail curators</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="emailCurator" name="emailCurator">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password">Password expo</label>
					<div class="controls">
						<input type="password" class="input-xlarge" id="password" name="password">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password">Repeat password</label>
					<div class="controls">
						<input type="password" class="input-xlarge" id="password2" name="password2">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="description">Description expo</label>
					<div class="controls">
						<textarea class="input-xlarge" id="description" name="description"  rows="3"></textarea>
					</div>
				</div>
	</div>
	<div class="modal-footer">
		<!-- 	<div class="form-actions"> -->
		<a type="submit" id="submitExpo" class="btn btn-primary">
			Save
		</a>
		<a id="cancelExpo" class="btn" data-toggle="modal" data-target="#expo-props">
			Cancel
		</a>
		<!-- 						</div> -->
		</fieldset>
		</form>
	</div>
</div>