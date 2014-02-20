(function() {
	tinymce.PluginManager.requireLangPack('groupdocs_viewer_java');
	tinymce.create('tinymce.plugins.GrpdocsPluginJava', {
		init : function(ed,url) {
			ed.addCommand('mceGrpdocsJava', function() {
				ed.windowManager.open( {
					file : url + '/../grpdocs-dialog.php',
					width : 420 + parseInt(ed.getLang('groupdocs_viewer_java.delta_width',0)),
					height : 540 + parseInt(ed.getLang('groupdocs_viewer_java.delta_height',0)),
					inline : 1}, {
						plugin_url : url,
						some_custom_arg : 'custom arg'
					}
				)}
			);
			ed.addButton('groupdocs_viewer_java', {
				title : 'GroupDocs Java Viewer Embedder',
				cmd : 'mceGrpdocsJava',
				image : url + '/../images/grpdocs-button.png'
			});
			ed.onNodeChange.add
				(function(ed,cm,n) {
					cm.setActive('groupdocs_viewer_java',n.nodeName=='IMG')
				})
		},
		createControl : function(n,cm) {
			return null
		},
		getInfo : function() { 
			return { 
				longname : 'GroupDocs Java Viewer Embedder',
				author : 'Marcketplace team',
				authorurl : 'http://www.groupdocs.com',
				infourl : 'http://www.groupdocs.com',
				version : "1.0"}
		}
	});
	tinymce.PluginManager.add('groupdocs_viewer_java',tinymce.plugins.GrpdocsPluginJava)
})();
