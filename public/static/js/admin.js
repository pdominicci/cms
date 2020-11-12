var base = location.protocol+'//'+location.host;

$(document).ready(function(){
    editor_init()
})

function editor_init(field){
    CKEDITOR.replace(field,{
        skin: 'moono',
        extraPlugins: 'codesnippet,ajax,xml,textmatch,autocomplete,textwatcher,emoji,panelbutton,preview,wordcount',
        toolbar: [
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo']},
            { name: 'basicstyles', items: [ 'Bold'  , 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockquote'] },
            { name: 'document', items: ['CodeSnippet', 'EmojiPanel', 'Preview', 'Source']}
        ],
    });
}