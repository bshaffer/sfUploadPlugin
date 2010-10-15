// This code has been rendered by the odcAttachmentPlugin

$(document).ready(function() {
  $('#upload-another').click(function() {
    var length     = $('div#uploads div.upload').length;
    var maxUploads = <?php echo sfConfig::get('app_uploads_max', 5) ?>;
    
    if (length < maxUploads)
    {
      var ptype = $('div#uploads div.prototype').html();
      ptype = ptype.replace('disabled', ''); // Enabled upload
      $('#upload-another').before('<div class="upload">' + ptype + '</div>');
    }
    
    if (length+1 >= maxUploads)
      $('#upload-another').hide();
    
    return false;
  });
  
  // $('.upload .checkbox').click(function(){
  //   if ($(this).attr('checked'))
  //     $(this).parent().find('input[type=hidden]').attr('disabled', 'disabled');
  //   else
  //     $(this).parent().find('input[type=hidden]').removeAttr('disabled');
  // });
});