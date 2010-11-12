// This code has been rendered by the odcAttachmentPlugin

$(document).ready(function() {
  $('.upload-another').click(function() {
    var uploadDiv  = $(this).parents('div.uploads');
    var length     = uploadDiv.find('div.upload').length;
    var maxUploads = uploadDiv.attr('max');
    
    if (!maxUploads || length < maxUploads)
    {
      var ptype = uploadDiv.find('div.prototype').html();
      ptype = ptype.replace('disabled', ''); // Enabled upload
      $(this).before('<div class="upload">' + ptype + '</div>');
    }

    if (maxUploads) 
    {    
      if (length+1 >= maxUploads)
        $(this).hide();
    }
    
    return false;
  });
  
  $('div.uploads').each(function(){
    var maxUploads = $(this).attr('max');
    if (maxUploads && $(this).find('div.upload').length >= maxUploads)
      $(this).find('.upload-another').hide();
  });
});