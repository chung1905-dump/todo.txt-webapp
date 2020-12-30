all: npm_install mkdir_out generate_svg generate_png

npm_install:
	npm install

mkdir_out:
	mkdir out -p

generate_svg: mkdir_out
	node generate-svg.js ${text} > out/icon.svg

generate_png: mkdir_out
	convert -size 180x ./out/icon.svg ./out/icon_180.png

clean:
	rm -rf node_modules out
