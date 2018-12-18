<?php
$now = \Moment::now();

$short_answer_sub_template = <<<SUB_TEMPLATE
	<div class="panel template short-answer" id="" data-attribute-type="single">
		<div class="panel-body mb-10">
			<div class="form-group">
				<div class="mb-10">
					<input type="text" class="form-control input-xlg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
				</div>
				<input type="text" class="form-control" value="short answer" readonly>
			</div>
		</div>
		<div class="panel-footer panel-footer-bordered">
			<div class="heading-elements">
				<span class="heading-text text-semibold">Short Answer Question Type</span>
				<div class="pull-right">
					<div class="heading-form">
						<div class="form-group">
							<label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
								<input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
								Required
							</label>
						</div>
					</div>
					<button type="button" class="btn bg-danger-400 btn-xs heading-btn question-delete" data-form="" data-form-field="">Delete</button>
				</div>
			</div>
		</div>
	</div>
SUB_TEMPLATE;

$short_answer_main_template = <<<MAIN_TEMPLATE
	<div class="row template short-answer">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Short Answer Question:</span></label>
				<input type="text" class="form-control" id="" name="" placeholder="Answer" value="" maxlength="255" minlength="3">
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$long_answer_sub_template = <<<SUB_TEMPLATE
	<div class="panel template long-answer" id="" data-attribute-type="single">
		<div class="panel-body mb-10">
			<div class="form-group">
				<div class="mb-10">
					<input type="text" class="form-control input-xlg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
				</div>
				<input type="text" class="form-control" value="long answer" readonly>
			</div>
		</div>
		<div class="panel-footer panel-footer-bordered">
			<div class="heading-elements">
				<span class="heading-text text-semibold">Long Answer Question Type</span>
				<div class="pull-right">
					<div class="heading-form">
						<div class="form-group">
							<label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
								<input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
								Required
							</label>
						</div>
					</div>
					<button type="button" class="btn bg-danger-400 btn-xs heading-btn question-delete" data-form="" data-form-field="">Delete</button>
				</div>
			</div>
		</div>
	</div>
SUB_TEMPLATE;

$long_answer_main_template = <<<MAIN_TEMPLATE
	<div class="row template long-answer">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Long Answer Question:</span></label>
				<textarea rows="1" cols="5" class="form-control elastic" id="" name="" placeholder="Answer" maxlength="30000" data-rule-min-words="3"></textarea>
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$multiple_choices_sub_template = <<<SUB_TEMPLATE
	<div class="panel template multiple-choices" id="" data-attribute-type="multiple">
		<div class="panel-body mb-10">
			<div class="form-group mb-10">
				<input type="text" class="form-control input-xlg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group mb-10">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="icon-radio-checked"></i>
							</span>
							<input type="text" id="" name="" class="form-control question-option" placeholder="Option 1" maxlength="255" minlength="3" required>
							<span class="input-group-addon no-padding-bottom">
								<button type="button" class="btn btn-xs btn-default add-option">Add Option</button>
							</span>
						</div>
					</div>
					<div class="options-wrapper">
						<div class="form-group mb-10 hidden" id="">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="icon-radio-checked"></i>
								</span>
								<input type="text" id="" class="form-control question-option" placeholder="Option" disabled>
								<span class="input-group-addon no-padding-bottom">
									<button type="button" class="btn btn-xs btn-default remove-option"><i class="icon-cross2"></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer panel-footer-bordered">
			<div class="heading-elements">
				<span class="heading-text text-semibold">Multiple Choices Question Type</span>
				<div class="pull-right">
					<div class="heading-form">
						<div class="form-group">
							<label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
								<input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
								Required
							</label>
						</div>
					</div>
					<button type="button" class="btn bg-danger-400 btn-xs heading-btn question-delete" data-form="" data-form-field="">Delete</button>
				</div>
			</div>
		</div>
	</div>
SUB_TEMPLATE;

$multiple_choices_main_template = <<<MAIN_TEMPLATE
	<div class="row template multiple-choices">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Multiple Choice Question:</span></label>
				<div class="options button radios">
					<div class="radio mt-15 mb-15 sample">
						<label class="option-label">
							<input type="radio" name="name" id="" class="styled"> <span class="option">Option 1</span>
						</label>
					</div>
				</div>
		    </div>
	    </div>
    </div>
MAIN_TEMPLATE;

$checkboxes_sub_template = <<<SUB_TEMPLATE
	<div class="panel template checkboxes" id="" data-attribute-type="multiple">
		<div class="panel-body mb-10">
			<div class="form-group mb-10">
				<input type="text" class="form-control input-xlg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group mb-10">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="icon-checkbox-checked"></i>
							</span>
							<input type="text" id="" name="" class="form-control question-option" placeholder="Option 1" maxlength="255" minlength="3" required>
							<span class="input-group-addon no-padding-bottom">
								<button type="button" class="btn btn-xs btn-default add-option">Add Option</button>
							</span>
						</div>
					</div>
					<div class="options-wrapper">
						<div class="form-group mb-10 hidden" id="">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="icon-checkbox-checked"></i>
								</span>
								<input type="text" id="" class="form-control question-option" placeholder="Option" disabled>
								<span class="input-group-addon no-padding-bottom">
									<button type="type" class="btn btn-xs btn-default remove-option"><i class="icon-cross2"></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer panel-footer-bordered">
			<div class="heading-elements">
				<span class="heading-text text-semibold">Chechboxes Question Type</span>
				<div class="pull-right">
					<div class="heading-form">
						<div class="form-group">
							<label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
								<input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
								Required
							</label>
						</div>
					</div>
					<button type="button" class="btn bg-danger-400 btn-xs heading-btn question-delete" data-form="" data-form-field="">Delete</button>
				</div>
			</div>
		</div>
	</div>
SUB_TEMPLATE;

$checkboxes_main_template = <<<MAIN_TEMPLATE
	<div class="row template checkboxes">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Checkbox Question:</span></label>
				<div class="options button checkboxes">
					<div class="checkbox mt-15 mb-15">
						<label>
							<input type="checkbox" class="styled" name=""> <span class="option">Option 1</span>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$drop_down_sub_template = <<<SUB_TEMPLATE
	<div class="panel template drop-down" id="" data-attribute-type="multiple">
		<div class="panel-body mb-10">
			<div class="form-group mb-10">
				<input type="text" class="form-control input-xlg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group mb-10">
						<div class="input-group">
							<span class="input-group-addon sn" data-sn="1" id="">
								1.
							</span>
							<input type="text" id="" name="" class="form-control question-option" placeholder="Option 1" maxlength="255" minlength="3" required>
							<span class="input-group-addon no-padding-bottom">
								<button type="button" class="btn btn-xs btn-default add-option">Add Option</button>
							</span>
						</div>
					</div>
					<div class="options-wrapper">
						<div class="form-group mb-10 hidden" id="">
							<div class="input-group">
								<span class="input-group-addon sn" data-sn="2" id="">
									2.
								</span>
								<input type="text" id="" class="form-control question-option" placeholder="Option" disabled>
								<span class="input-group-addon no-padding-bottom">
									<button type="type" class="btn btn-xs btn-default remove-option"><i class="icon-cross2"></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer panel-footer-bordered">
			<div class="heading-elements">
				<span class="heading-text text-semibold">Drop Down Question Type</span>
				<div class="pull-right">
					<div class="heading-form">
						<div class="form-group">
							<label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
								<input type="checkbox" class="switchery question-required" checked="checked">
								Required
							</label>
						</div>
					</div>
					<button type="button" class="btn bg-danger-400 btn-xs heading-btn question-delete">Delete</button>
				</div>
			</div>
		</div>
	</div>
SUB_TEMPLATE;

$drop_down_main_template = <<<MAIN_TEMPLATE
	<div class="row template drop-down">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Drop Down Question:</span></label>
				<div class="options select">
					<select class="select" name="" data-width="100%">
					</select>
				</div>
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$linear_scale_sub_template = <<<SUB_TEMPLATE
	<div class="panel template linear-scale" id="" data-attribute-type="multiple">
		<div class="panel-body mb-10">
			<div class="form-group mb-10">
				<input type="text" class="form-control input-xlg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
			</div>
			<div class="row mb-10">
				<div class="col-md-1">
					<div class="form-group">
						<select class="bootstrap-select select min question-option key" name="" data-width="100%" required>
							<option value="0" id="">0</option>
							<option value="1" id="" selected>1</option>
						</select>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-control-static text-center">to</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<select class="bootstrap-select select max question-option key" name="" data-width="100%" required>
							<option value="2" id="">2</option>
							<option value="3" id="">3</option>
							<option value="4" id="">4</option>
							<option value="5" id="" selected>5</option>
							<option value="6" id="">6</option>
							<option value="7" id="">7</option>
							<option value="8" id="">8</option>
							<option value="9" id="">9</option>
							<option value="10" id="">10</option>
						</select>
					</div>
				</div>
			</div>
			<div class="select-labels">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon min-value" id="">1.</span>
								<input type="text" id="" name="" class="form-control question-option-label min value" placeholder="Label (optional)">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon max-value" id="">5.</span>
								<input type="text" id="" name="" class="form-control question-option-label max value" placeholder="Label (optional)">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer panel-footer-bordered">
			<div class="heading-elements">
				<span class="heading-text text-semibold">Linear Scale Question Type</span>
				<div class="pull-right">
					<div class="heading-form">
						<div class="form-group">
							<label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
								<input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
								Required
							</label>
						</div>
					</div>
					<button type="button" class="btn bg-danger-400 btn-xs heading-btn question-delete" data-form="" data-form-field="">Delete</button>
				</div>
			</div>
		</div>
	</div>
SUB_TEMPLATE;

$linear_scale_main_template = <<<MAIN_TEMPLATE
	<div class="row template linear-scale">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Linear Scale Question:</span></label>
				<div class="options scale">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<div class="input-group">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$date_sub_template = <<<SUB_TEMPLATE
	<div class="panel template date" id="" data-attribute-type="single">
		<div class="panel-body mb-10">
			<div class="form-group">
				<div class="mb-10">
					<input type="text" class="form-control input-xlg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
				</div>
				<div class="input-group col-md-6">
					<span class="input-group-addon">
						<i class="icon-calendar3"></i>
					</span>
					<input type="text" class="form-control" placeholder="Day, Month, Year" readonly>
				</div>
			</div>
		</div>
		<div class="panel-footer panel-footer-bordered">
			<div class="heading-elements">
				<span class="heading-text text-semibold">Date Question Type</span>
				<div class="pull-right">
					<div class="heading-form">
						<div class="form-group">
							<label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
								<input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
								Required
							</label>
						</div>
					</div>
					<button type="button" class="btn bg-danger-400 btn-xs heading-btn question-delete" data-form="" data-form-field="">Delete</button>
				</div>
			</div>
		</div>
	</div>
SUB_TEMPLATE;

$current_date = $now->format('jS, F Y');
$date_main_template = <<<MAIN_TEMPLATE
	<div class="row template date">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Date Question:</span></label>
				<input type="date" name="" class="form-control pickadate" value="" placeholder="$current_date" data-msg="Date is required">
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$time_sub_template = <<<SUB_TEMPLATE
	<div class="panel template time" id="" data-attribute-type="single">
		<div class="panel-body mb-10">
			<div class="form-group">
				<div class="mb-10">
					<input type="text" class="form-control input-xlg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
				</div>
				<div class="input-group col-md-6">
					<span class="input-group-addon">
						<i class="icon-alarm"></i>
					</span>
					<input type="text" class="form-control" placeholder="Time" readonly>
				</div>
			</div>
		</div>
		<div class="panel-footer panel-footer-bordered">
			<div class="heading-elements">
				<span class="heading-text text-semibold">Time Question Type</span>
				<div class="pull-right">
					<div class="heading-form">
						<div class="form-group">
							<label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
								<input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
								Required
							</label>
						</div>
					</div>
					<button type="button" class="btn bg-danger-400 btn-xs heading-btn question-delete" data-form="" data-form-field="">Delete</button>
				</div>
			</div>
		</div>
	</div>
SUB_TEMPLATE;

$current_time = $now->format('h:i A');
$time_main_template = <<<MAIN_TEMPLATE
	<div class="row template time">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Time Question:</span></label>
				<input type="time" class="form-control pickatime" placeholder="$current_time">
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

return [
	[
		'name' => 'Short Answer',
		'alias' => 'short-answer',
		'sub_template' => $short_answer_sub_template,
		'main_template' => $short_answer_main_template,
		'attribute_type' => 'string',
	],
	[
		'name' => 'Long Answer',
		'alias' => 'long-answer',
		'sub_template' => $long_answer_sub_template,
		'main_template' => $long_answer_main_template,
		'attribute_type' => 'string',
	],
	[
		'name' => 'Multiple Choice',
		'alias' => 'multiple-choices',
		'sub_template' => $multiple_choices_sub_template,
		'main_template' => $multiple_choices_main_template,
		'attribute_type' => 'array',
	],
	[
		'name' => 'Chechboxes',
		'alias' => 'checkboxes',
		'sub_template' => $checkboxes_sub_template,
		'main_template' => $checkboxes_main_template,
		'attribute_type' => 'array',
	],
	[
		'name' => 'Drop-down',
		'alias' => 'drop-down',
		'sub_template' => $drop_down_sub_template,
		'main_template' => $drop_down_main_template,
		'attribute_type' => 'array',
	],
	[
		'name' => 'Linear Scale',
		'alias' => 'linear-scale',
		'sub_template' => $linear_scale_sub_template,
		'main_template' => $linear_scale_main_template,
		'attribute_type' => 'array',
	],
	[
		'name' => 'Date',
		'alias' => 'date',
		'sub_template' => $date_sub_template,
		'main_template' => $date_main_template,
		'attribute_type' => 'string',
	],
	[
		'name' => 'Time',
		'alias' => 'time',
		'sub_template' => $time_sub_template,
		'main_template' => $time_main_template,
		'attribute_type' => 'string',
	],
];
