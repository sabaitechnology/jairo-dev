
#
# Top-level Makefile for the JaiRo Project
# Sabai Technology
#

BASH := $(shell which bash)
ifdef BASH
	SHELL = $(BASH)
endif

export installRoot = $(shell pwd)

# update: $(shell find jai -type f) $(shell find configuration -type f)

# built/jairo.deb: update
# 	dpkg-deb --build ./debian built/jairo.deb

# debian: built/jairo.deb

# jainode: dependencies

jainode:
	# MAKE $@
	@install/install-jainode.sh
	# DONE $@

dependencies:
	# MAKE $@
	#@install/dependencies.sh
	# DONE $@

#dev-install: dependencies jainode

dev-install:
	# MAKE $@
	# $(installRoot)
	touch hi
	# DONE $@

clean:
	# MAKE $@
#	@rm built/*
	@echo clean
	# DONE $@

.PHONY: clean debian dependencies dev-install jainode

# demo:
# 	@rm -rf demo
# 	cp -r jai demo
# 	rm demo/apps
# 	cp -r apps demo/
# 	rm -rf demo/apps/basicNetwork/php
# 	mv demo/apps/basicNetwork/demo demo/apps/basicNetwork/php
