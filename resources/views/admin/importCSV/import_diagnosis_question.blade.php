<form method="POST" action="/admin/import_diagnosis_qiestion" enctype="multipart/form-data">
    @csrf

    <input type="file" id="file" name="file" class="form-control">

    <button type="submit">アップロード</button>

</form>