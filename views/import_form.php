<form method='post' enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="form-group">
        <label>Selectionnez une image à importer</label><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="50000000" />
        <div class="custom-file">
            <input class="custom-file-input" type='file' name='image' id='image'>
            <label class="custom-file-label" for="image">Choose file</label>
        </div><br>
        <input class="btn btn-dark mt-1" type='submit' value='Importer' name='btnImport'>
    </div>
</form>
<br>