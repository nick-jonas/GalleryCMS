<?php $this->load->view('inc/header'); ?>

<?php if (isset($flash)): ?>
<div class="alert alert-success"><a class="close" data-dismiss="alert">x</a><strong><?php echo $flash; ?></strong></div>
<?php endif; ?>

<div class="page-header">
  <h1>Albums</h1>
</div>

<h4>My JSON feed: <pre style="font-weight:normal;"><a href="<?php echo site_url("api/my_feed/json/$user->uuid"); ?>"><?php echo site_url("api/my_feed/json/$user->uuid"); ?></a></pre></h4>
<h4>My XML feed: <pre style="font-weight:normal;"><a href="<?php echo site_url("api/my_feed/xml/$user->uuid"); ?>"><?php echo site_url("api/my_feed/xml/$user->uuid"); ?></a></pre></h4>

<?php if (isset($albums)): ?>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th width="160">Created</th>
      <th width="160">Updated</th>
      <th width="70">Photos</th>
      <th width="140"><a class="btn btn-primary" href="<?php echo site_url("album/create"); ?>">Create new album</a></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($albums as $album): ?>
    <tr>
      <td><a href="<?php echo site_url("album/images/" . $album['id']); ?>"><?php echo $album['name']; ?></a></td>
      <td><?php echo date('M d, Y', strtotime($album['created_at'])); ?></td>
      <td><?php echo date('M d, Y', strtotime($album['updated_at'])); ?></td>
      <td><?php echo $album['total_images']; ?></td>
      <td>
        <div class="btn-group">
          <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            Action
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("album/edit/" . $album['id']); ?>"><i class="icon-pencil"></i> Rename</a></li>
            <li><a href="<?php echo site_url("album/images/" . $album['id']); ?>"><i class="icon-picture"></i> Images</a></li>
            <li><a href="<?php echo site_url("album/configure/" . $album['id']); ?>"><i class="icon-cog"></i> Configure</a></li>
            <li><a class="album-delete-btn" href="#album-modal" data-toggle="modal" rel="<?php echo site_url("album/remove/" . $album['id']); ?>"><i class="icon-trash"></i> Delete</a></li>
          </ul>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

<?php echo $this->pagination->create_links(); ?>

<div class="modal hide fade" id="album-modal">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Delete Album</h3>
  </div>
  <div class="modal-body">
    <p><strong>Are you sure you want to delete this album?</strong></p>
    <p>This will permanently delete all photos in this album.</p>
  </div>
  <div class="modal-footer">
    <a id="album-modal-delete-btn" href="#" class="btn btn-danger">Delete</a>
    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
  </div>
</div>

<script type="text/javascript">
var deleteUrl;
$(document).ready(function() {
  $('.album-delete-btn').click(function() {
    deleteUrl = $(this).attr('rel');
  });
  
  $('#album-modal').on('show', function() {
    $('#album-modal-delete-btn').attr('href', deleteUrl);
  });
});
</script>

<?php $this->load->view('inc/footer'); ?>
