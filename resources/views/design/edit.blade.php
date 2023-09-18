@extends('layout.metronic')
@php
    $title= $design->cname ;
@endphp
@section('page', $title.'- Edit Content')
@section('content')
@include('layout.tiny')
<script src="{{ url('') }}/assets/scripts/jquery.min.js"></script>

<form action="{{ url('') }}/content/{{encrypt( $design->id )}}" method="POST" class="row col-12">
    @csrf
    @method('PUT')
<div class="row ">

            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Content name:</label>
                    <input type="text" class="form-control input-sm" name="name" id="cname" value="{{ $design->cname }}" readonly/>
                </div>
            </div>
            <div class="col-md-12">
                <div id="code">
                    <textarea id="tinymce">
                        {{ $design->cdata }}
                    </textarea>
                </div>
            </div>

            <textarea style="display: none;" id="codefinel" name="content">
                {{ $design->cdata }}
            </textarea>





     <script>
       tinymce.init({
         selector: 'textarea#tinymce',
         plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
         toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
         codesample_languages: [
                {text: 'HTML/XML', value: 'markup'},
                {text: 'JavaScript', value: 'javascript'},
                {text: 'CSS', value: 'css'},
                {text: 'PHP', value: 'php'},
                {text: 'Ruby', value: 'ruby'},
                {text: 'Python', value: 'python'},
                {text: 'Java', value: 'java'},
                {text: 'C', value: 'c'},
                {text: 'C#', value: 'csharp'},
                {text: 'C++', value: 'cpp'}
            ],
            setup: function (editor) {
	            editor.ui.registry.addButton('custom_button', {
	                text: 'Add Button',
	                onAction: function() {
	                    // Open a Dialog
	                    editor.windowManager.open({
	                        title: 'Add custom button',
	                        body: {
	                            type: 'panel',
	                            items: [{
	                                type: 'input',
	                                name: 'button_label',
	                                label: 'Button label',
	                                flex: true
	                            },{
	                                type: 'input',
	                                name: 'button_href',
	                                label: 'Button href',
	                                flex: true
	                            },{
	                                type: 'selectbox',
	                                name: 'button_target',
	                                label: 'Target',
	                                items: [
	                                    {text: 'None', value: ''},
	                                    {text: 'New window', value: '_blank'},
	                                    {text: 'Self', value: '_self'},
	                                    {text: 'Parent', value: '_parent'}
	                                ],
	                                flex: true
	                            },{
	                                type: 'selectbox',
	                                name: 'button_rel',
	                                label: 'Rel',
	                                items: [
	                                    {text: 'No value', value: ''},
	                                    {text: 'Alternate', value: 'alternate'},
	                                    {text: 'Help', value: 'help'},
	                                    {text: 'Manifest', value: 'manifest'},
	                                    {text: 'No follow', value: 'nofollow'},
	                                    {text: 'No opener', value: 'noopener'},
	                                    {text: 'No referrer', value: 'noreferrer'},
	                                    {text: 'Opener', value: 'opener'}
	                                ],
	                                flex: true
	                            },{
	                                type: 'selectbox',
	                                name: 'button_style',
	                                label: 'Style',
	                                items: [
	                                    {text: 'Success', value: 'success'},
	                                    {text: 'Info', value: 'info'},
	                                    {text: 'Warning', value: 'warning'},
	                                    {text: 'Error', value: 'error'}
	                                ],
	                                flex: true
	                            }]
	                        },
	                        onSubmit: function (api) {

	                        	var html = '<a href="'+api.getData().button_href+'" class="btn btn-'+api.getData().button_style+'" rel="'+api.getData().button_rel+'" target="'+api.getData().button_target+'">'+api.getData().button_label+'</a>';

	                            // insert markup
	                            editor.insertContent(html);

	                            // close the dialog
	                            api.close();
	                        },
	                        buttons: [
	                            {
	                                text: 'Close',
	                                type: 'cancel',
	                                onclick: 'close'
	                            },
	                            {
	                                text: 'Insert',
	                                type: 'submit',
	                                primary: true,
	                                enabled: false
	                            }
	                        ]
	                    });
	                }
	            });
	        }
       });
     </script>

<script>
    $(document).ready(function(){
        $("#code").mouseleave(function(){
            var content = tinyMCE.get('tinymce').getContent();
		    console.log(content);
            $("#codefinel").val(content);
        });

        $('#save').click(function () {
            $cname = $('#cname').val();
            if ($cname === '') {
                //alert('No');
                $('#cname').addClass('border border-danger');
                return false;
            }

        });
        $("#cname").blur(function(){
            $(this).removeClass('border border-danger');
        });

    });

</script>
<script>
    $page='content';
</script>
</div>
<div class="col-12 border border-right-0  border-bottom-0 border-left-0 pt-4 pb-4 m-0">
    <button class="btn btn-primary float-right mr-2" type="submit" id="save"> <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Save</button>
    <button onclick="history.back()"  class="btn btn-secondary float-right mr-2 closeBtn"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel</button>

</div>
</form>
@endsection
