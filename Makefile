
update: $(shell find jai -type f) $(shell find configuration -type f)

built/jairo.deb: update
	dpkg-deb --build ./debian built/jairo.deb

debian: built/jairo.deb

.PHONY : clean debian

clean:
	@rm built/*

demo:
	rm -rf demo
	cp -r jai demo
	