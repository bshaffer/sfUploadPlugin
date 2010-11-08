<?php if ($sf_user->hasCredential(odcACL::ATTACHMENT_DOWNLOAD)): ?>
  <?php foreach ($uploads as $name => $file): ?>
    <a href="<?php echo sprintf('%s/%s', ($path ? $path : ($sf_request->getRelativeUrlRoot().'/uploads')), $file) ?>">
      <?php echo $name ?>
    </a> &nbsp; 
  <?php endforeach; ?>             
<?php else: ?>
  <?php echo link_to('Login', '@login') ?> to download.              
<?php endif ?>
