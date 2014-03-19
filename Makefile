
#
# Top-level Makefile for the JaiRo Project
# Sabai Technology
#

BASH := $(shell which bash)
ifdef BASH
	SHELL = $(BASH)
endif

# update: $(shell find jai -type f) $(shell find configuration -type f)

# built/jairo.deb: update
# 	dpkg-deb --build ./debian built/jairo.deb

# debian: built/jairo.deb

dependencies:
	# MAKE $@
	@install/dependencies.sh

dev-install: dependencies
	# MAKE $@
	echo hi

.PHONY : clean debian dependencies dev-install

clean:
#	@rm built/*

# demo:
# 	@rm -rf demo
# 	cp -r jai demo
# 	rm demo/apps
# 	cp -r apps demo/
# 	rm -rf demo/apps/basicNetwork/php
# 	mv demo/apps/basicNetwork/demo demo/apps/basicNetwork/php
