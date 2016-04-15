

<script>
$(function(){

    //If loading a saved form from your database, put the ID here. Example id is "1".

    var formID = '1';


    //Adds new field with animation
    $("#add-field a").click(function() {
        event.preventDefault();
        $(addField($(this).data('type'))).appendTo('#form-fields').hide().slideDown('fast');
        $('#form-fields').sortable();
    });

    //Removes fields and choices with animation
    $("#sjfb").on("click", ".delete", function() {
        if (confirm('Are you sure?')) {
            var $this = $(this);
            $this.parent().slideUp( "slow", function() {
                $this.parent().remove()
            });
        }
    });

    //Makes fields required
    $("#sjfb").on("click", ".toggle-required", function() {
        requiredField($(this));
    });

    //Makes choices selected
    $("#sjfb").on("click", ".toggle-selected", function() {
        selectedChoice($(this));
    });

    //Adds new choice to field with animation
    $("#sjfb").on("click", ".add-choice", function() {
        $(addChoice()).appendTo($(this).prev()).hide().slideDown('fast');
        $('.choices ul').sortable();
    });

    //Saving form
    $("#sjfb").submit(function(event) {
        event.preventDefault();

        //Loop through fields and save field data to array
        var fields = [];

        $('.field').each(function() {

            var $this = $(this);

            //field type
            var fieldType = $this.data('type');

            //field label
            var fieldLabel = $this.find('.field-label').val();

            //field required
            var fieldReq = $this.hasClass('required') ? 1 : 0;

            //check if this field has choices
            if($this.find('.choices li').length >= 1) {

                var choices = [];

                $this.find('.choices li').each(function() {

                    var $thisChoice = $(this);

                    //choice label
                    var choiceLabel = $thisChoice.find('.choice-label').val();

                    //choice selected
                    var choiceSel = $thisChoice.hasClass('selected') ? 1 : 0;

                    choices.push({
                        label: choiceLabel,
                        sel: choiceSel
                    });

                });
            }

            fields.push({
                type: fieldType,
                label: fieldLabel,
                req: fieldReq,
                choices: choices
            });

        });

        var frontEndFormHTML = '';

function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}

var template = $_GET('TemplateName');

        //Save form to database
        //Demo doesn't actually save. Download project files for save
        var data = JSON.stringify([{"name":"formID","value":formID},{"name":"formFields","value":fields}]);
        $.ajax({
            method: "POST",
            url: "sjfb-save.php?TemplateName=" + template + "&name=<?php echo $_SESSION['user_name'];?>",
            data: data, 
            dataType: 'json',
            success: function (msg) {
                console.log(msg);
                $('.alert').removeClass('hide');
                $("html, body").animate({ scrollTop: 0 }, "fast");

                //Demo only
                $('.alert textarea').val(JSON.stringify(fields));
            }
        });
    });

    //load saved form
    loadForm(formID);

});

//Add field to builder
function addField(fieldType) {

    var hasRequired, hasChoices;
    var includeRequiredHTML = '';
    var includeChoicesHTML = '';

    switch (fieldType) {
            case 'text1':
            hasRequired = true;
            hasChoices = false;
            break;
        case 'text':
            hasRequired = true;
            hasChoices = false;
            break;
        case 'date':
            hasRequired = true;
            hasChoices = false;
            break;
        case 'textarea':
            hasRequired = true;
            hasChoices = false;
            break;
        case 'select':
            hasRequired = true;
            hasChoices = true;
            break;
        case 'radio':
            hasRequired = true;
            hasChoices = true;
            break;
        case 'checkbox':
            hasRequired = false;
            hasChoices = true;
            break;
        case 'agree':
            //required "agree to terms" checkbox
            hasRequired = false;
            hasChoices = false;
            break;
    }

    if (hasRequired) {
        includeRequiredHTML = '' +
            '<label>Required? ' +
            '<input class="toggle-required" type="checkbox">' +
            '</label>'
    }

    if (hasChoices) {
        includeChoicesHTML = '' +
            '<div class="choices">' +
            '<ul></ul>' +
            '<button type="button" class="add-choice">Add Choice</button>' +
            '</div>'
    }

    return '' +
        '<div class="field" data-type="' + fieldType + '">' +
        '<button type="button"  class="delete">Delete Field</button>' +
        '<h3>' + fieldType + '</h3>' +
        '<label>Label:' + 
        '<input type="text" class="field-label" pattern="[a-zA-Z0-9 ]+" placeholder="A-Z & 1-9 only">' +
        '</label>' +
        includeRequiredHTML +
        includeChoicesHTML +
        '</div>'
}

//Make builder field required
function requiredField($this) {
    if (!$this.parents('.field').hasClass('required')) {
        //Field required
        $this.parents('.field').addClass('required');
        $this.attr('checked','checked');
    } else {
        //Field not required
        $this.parents('.field').removeClass('required');
        $this.removeAttr('checked');
    }
}

function selectedChoice($this) {
    if (! $this.parents('li').hasClass('selected')) {

        //Only checkboxes can have more than one item selected at a time
        //If this is not a checkbox group, unselect the choices before selecting
        if ($this.parents('.field').data('type') != 'checkbox') {
            $this.parents('.choices').find('li').removeClass('selected');
            $this.parents('.choices').find('.toggle-selected').not($this).removeAttr('checked');
        }

        //Make selected
        $this.parents('li').addClass('selected');
        $this.attr('checked','checked');

    } else {

        //Unselect
        $this.parents('li').removeClass('selected');
        $this.removeAttr('checked');

    }
}

//Builder HTML for select, radio, and checkbox choices
function addChoice() {
    return '' +
        '<li>' +
        '<label>Choice: ' +
        '<input type="text" class="choice-label" pattern="[a-zA-Z0-9 ]+">' +
        '</label>' +
        '<label>Selected? ' +
        '<input class="toggle-selected" type="checkbox" pattern="[a-zA-Z0-9 ]+">' +
        '</label>' +
        '<button type="button" class="delete">Delete Choice</button>' +
        '</li>'
}


formID = 144;
//Loads a saved form from your database into the builder
function loadForm(formID) {
    $.getJSON('sjfb-load.php?form_id=' + formID, function(data) {
        if (data) {
            //go through each saved field object and render the builder
            $.each( data, function( k, v ) {
                //Add the field
                $(addField(v['type'])).appendTo('#form-fields').hide().slideDown('fast');
                var $currentField = $('#form-fields .field').last();

                //Add the label
                $currentField.find('.field-label').val(v['label']);

                //Is it required?
                if (v['req']) {
                    requiredField($currentField.find('.toggle-required'));
                }

                //Any choices?
                if (v['choices']) {
                    $.each( v['choices'], function( k, v ) {
                        //add the choices
                        $currentField.find('.choices ul').append(addChoice());

                        //Add the label
                        $currentField.find('.choice-label').last().val(v['label']);

                        //Is it selected?
                        if (v['sel']) {
                            selectedChoice($currentField.find('.toggle-selected').last());
                        }
                    });
                }

            });

            $('#form-fields').sortable();
            $('.choices ul').sortable();
        }
    });
}
</script> <!-- form builder -->
<script src="js/sjfb-html-generator.js" type="text/javascript" ></script> <!-- form generator -->
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="sjfb-wrap" style="padding:0 !important;" class="col-lg-10">

    <h1>Report Template Maker</h1>

    <div class="add-wrap three" style="border-radius:30px !important;">
        <h3>Add Field:</h3>
        <ul id="add-field">
            <li><a id="add-text" data-type="text" href="#">Single Line Text</a></li>
<li><a id="add-text" data-type="date" href="#">Date</a></li>
            <li><a id="add-textarea" data-type="textarea" href="#">Multi Line Text</a></li>
            <li><a id="add-select" data-type="select" href="#">Select Box (Drop down list)</a></li>
            <li><a id="add-radio" data-type="radio" href="#">Radio Buttons</a></li>
            <li><a id="add-checkbox" data-type="checkbox" href="#">Checkboxes</a></li>
           
        </ul>
    </div>

  <form id="sjfb" onsubmit="location.href = 'index.php?source=CreateReportTemplate&msg=1';">
        <div id="form-fields">

<div class="field required ui-sortable-handle" data-type="text2" style="display: block;"><h3>Raiser</h3><label>Label:<input type="text" class="field-label" value="Report Raiser" readonly></label><div class="hidden"><label>Required? <input class="toggle-required" type="checkbox" checked="checked"></label></div></div>

<div class="field required ui-sortable-handle" data-type="text4" style="display: block;"><h3>Date</h3><label>Label:<input type="text" class="field-label" value="Submission Date" readonly></label><div class="hidden"><label>Required? <input class="toggle-required" type="checkbox" checked="checked"></label></div></div>

<div class="field required ui-sortable-handle" data-type="text3" style="display: block;"><h3>Owner</h3><label>Label:<input type="text" class="field-label" value="Report Owner" readonly></label><div class="hidden"><label>Required? <input class="toggle-required" type="checkbox" checked="checked"></label></div></div>

<div class="field" data-type="textarea" style="display: block;"><button type="button" class="delete">Delete Field</button><h3>textarea</h3><label>Label:<input type="text" class="field-label" value="Details"></label><label>Required? <input class="toggle-required" type="checkbox"></label></div>

        </div>
        <button type="submit" class="submit btn btn-info one" > Save Form</button>
    </form>

</div>
