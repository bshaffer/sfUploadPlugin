<?php if ($sf_user->hasCredential(odcACL::ATTACHMENT_DOWNLOAD)): ?>
  <?php foreach ($uploads as $name => $file): ?>
    <a href="<?php echo sprintf('%s/uploads%s/%s', $sf_request->getRelativeUrlRoot(), (isset($path) ? $path : ''), $file) ?>">
      <?php echo $name ?>
    </a> &nbsp; 
  <?php endforeach; ?>             
<?php else: ?>
  <?php echo link_to('Login', '@login') ?> to download.              
<?php endif ?>
