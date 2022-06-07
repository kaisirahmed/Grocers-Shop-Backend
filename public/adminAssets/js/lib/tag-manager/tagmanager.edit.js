    
function deleteTags($id) {
    var text = $('#'+$id).text();
    var tags = $('#pre_tags').val();
    var tagsArr = tags.split(',');
    preTags = tagsArr.filter(v => v !== text);

    $('#pre_tags').val(preTags);
    $('#'+$id).remove();
}
  