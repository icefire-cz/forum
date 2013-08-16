.PHONY: design/custom.css js/custom.js

all: css js

css: design/custom.css

design/custom.css: design/app.less
	lessc design/app.less > temp.css
	java -jar yui.jar temp.css -o design/custom.css
	rm -f temp.css

js: js/custom.js

js/custom.js: js/app.js
	cat js/app.js js/modules/* > temp.js
	java -jar yui.jar temp.js -o js/custom.js
	rm -f temp.js

clean:
	rm -f design/custom.css js/custom.js
