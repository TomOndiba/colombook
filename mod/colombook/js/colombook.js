
function colombook_jump(url) {
    elgg.get(url, { success: function(resultText,success,xhr) {
            $("#colombook_content").html(resultText);
    }});
}


