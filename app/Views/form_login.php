<?=$this->extend('layout')?>

<?=$this->section('konten')?>
<div class="row">
	<div class="col-md-5 mx-auto">
		<div class="card">
			<?=form_open(route_to('login'));?>
				<div class="card-body">
					<div class="mb-3">
						<label for="" class="form-label">Email</label>
						<input type="email" name="email" value="<?=old('email')?>" class="form-control" placeholder="Email" required="">
						<p><?=session('errors.email');?></p>
					</div>
					<div class="mb-3">
						<label for="" class="form-label">Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required="" autocomplete="new-password">
						<p><?=session('errors.password');?></p>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<input type="checkbox" name="remember" value="true" class="form-check-input" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault"> &nbsp; Remember me</label>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Sign in</button>
				</div>
			<?=form_close();?>
		</div>
	</div>
</div>
<?=$this->endSection()?>