<?php
$this->start('title');
echo $this->Html->titleForLayout(__('Error 500. Oooops, Something went wrong!'));
$this->end();

$this->start('navigation');
switch($this->Session->read('Auth.User.user_group_id')) {
  case 1:
  case 2:
    echo $this->element('admin_navigation');
    break;
  case 3:
    echo $this->element('panel_navigation');
    break;
  case 4:
    echo $this->element('agent_navigation');
    break;
}
$this->end();
?>



        <div class="row">
				
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
						<div class="row">
							<div class="col-sm-12">
								<div class="text-center error-box">
									<h1 class="error-text tada animated"><i class="fa fa-times-circle text-danger error-icon-shadow"></i> Error 500</h1>
									<h2 class="font-xl"><strong>Oooops, Something went wrong!</strong></h2>
									<br />
									<p class="lead semi-bold">
										<strong>You have experienced a technical error. We apologize.</strong><br><br>
										<small>
											We are working hard to correct this issue. Please wait a few moments and try your search again. <br> In the meantime, check out whats new on SmartAdmin:
										</small>
									</p>
								</div>
				
							</div>
				
						</div>
				
					</div>
					
				</div>
