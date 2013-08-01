function Gdn_FirstLastNames() {

   this.InsertMode = 'default';
   this.Editors = [];
   this.EditorID = 1;

   Gdn_FirstLastNames.prototype.Prepare = function() {

      $('span.realusername').livequery('click', jQuery.proxy(function(event){
         var RealUsernameLink = $(event.target);
         this.Mention(RealUsernameLink);
         return false;
      },this));

      var FirstLastNames = this;
      $('textarea.TextBox').livequery(function(){
         FirstLastNames.EditorStack(this);
      }, function(){
         FirstLastNames.EditorStack(this, true);
      });

      $('div.cleditorMain').livequery(function(){
         FirstLastNames.SetInsertMode('cleditor', this);
      });
   };

   Gdn_FirstLastNames.prototype.SetInsertMode = function(InsertMode, ChangeElement) {
      var OldInsert = this.InsertMode;
      var Changed = (OldInsert == InsertMode);
      this.InsertMode = InsertMode;

      switch (this.InsertMode) {
         case 'cleditor':

            var Frame = $($(ChangeElement).find('textarea.TextBox').get(0).editor.$frame).get(0);
            var FrameBody = null;
            var FrameDocument = null;

            if (Frame.contentDocument) {
               FrameDocument = Frame.contentDocument;
               FrameBody = FrameDocument.body;
            } else if (Frame.contentWindow) {
               FrameDocument = Frame.contentWindow.document;
               FrameBody = FrameDocument.body;
            }

            if (FrameBody == null) return;

			var webRoot = gdn.definition('WebRoot', '');
            var ss = document.createElement("link");
            ss.type = "text/css";
            ss.rel = "stylesheet";
            ss.href = gdn.combinePaths(webRoot, '/plugins/Quotes/css/cleditor.css');

            if (document.all)
            	FrameDocument.createStyleSheet(ss.href);
            else
            	FrameDocument.getElementsByTagName("head")[0].appendChild(ss);

         break;

         case 'default':
         default:
         break;
      }
   };

   Gdn_FirstLastNames.prototype.EditorStack = function(AreaContainer, Remove) {
      if (AreaContainer == undefined) return false;

      var TextArea = null;
      if ($(AreaContainer).get(0).nodeName.toLowerCase() == 'textarea')
         TextArea = $(AreaContainer);
      else {
         TextArea = $(AreaContainer).find('textarea.TextBox');
         if (TextArea.length == 0) return false;
      }

      if (Remove == undefined || Remove == false) {
         if (TextArea.length) {
            TextArea.get(0).eid = this.EditorID++;
            this.Editors.push(TextArea);
         }
      } else {
         var EID = TextArea.get(0).eid;

         $(this.Editors).each(jQuery.proxy(function(i,el){
            if (el.get(0).eid == EID) {
               this.Editors.splice(i,1);
               return;
            }
         },this));
      }

      return true;
   };

   Gdn_FirstLastNames.prototype.GetEditor = function() {
      return this.Editors[this.Editors.length-1];
   };

   Gdn_FirstLastNames.prototype.Mention = function(RealUsernameLink) {
      console.log(RealUsernameLink);
      this.InsertMention(RealUsernameLink.attr('title'));

      switch (this.InsertMode) {
         case 'cleditor':
            var ScrollY = $(this.GetEditor().get(0).editor.$frame).offset().top - 100;
         break;

         case 'default':
         default:
            var ScrollY = this.GetEditor().offset().top - 100;
         break;
      }

      $('html,body').animate({scrollTop: ScrollY}, 800);
   };

   Gdn_FirstLastNames.prototype.InsertMention = function(Text) {
      var Editor = this.GetEditor();
      Editor.val(Editor.val() + '@' + Text + ' ');

      switch (this.InsertMode) {
         case 'cleditor':
            Editor.val(Editor.val() + "<br/>");
            Editor.get(0).editor.updateFrame();
         break;

         case 'default':
         default:
         break;
      }
   };
}

var GdnFirstLastNames = null;
jQuery(document).ready(function(){
   GdnFirstLastNames = new Gdn_FirstLastNames();
   GdnFirstLastNames.Prepare();
});
