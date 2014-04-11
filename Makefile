
#
# Top-level Makefile for the JaiRo Project
# Sabai Technology
#

BASH := $(shell which bash)
ifdef BASH
	SHELL = $(BASH)
endif

include options.make

.PHONY: help dependencies jainode dev jairo debian clean

help:
	-@cat README

# We have an empty rule for the Makefile to keep make from bothering
Makefile: ;

dependencies:
	# MAKE: $@
	#@makeScripts/install-dependencies.sh
	# DONE: $@

jai:
	# MAKE: $@
#	#@makeScripts/install-jainode.sh
	# DONE: $@

# jainode: dependencies
ro:
	# MAKE: $@
#	#@makeScripts/install-jainode.sh
	# DONE: $@

#dev-install: dependencies jainode jaiui
dev:
	# MAKE: $@
	@$(MAKE) jairo development=true
	# DONE: $@

jairo: dependencies ro jai
	# MAKE: $@
	@makeScripts/install-jainode.sh
	# DONE: $@


# update: $(shell find jai -type f) $(shell find configuration -type f)

# built/jairo.deb: update
#	@makeScripts/create-debian-package.sh

# debian: built/jairo.deb

clean:
	# MAKE $@
#	@rm built/*
	@echo "clean?"
	# DONE $@

# demo:
# 	@rm -rf demo
# 	cp -r jai demo
# 	rm demo/apps
# 	cp -r apps demo/
# 	rm -rf demo/apps/basicNetwork/php
# 	mv demo/apps/basicNetwork/demo demo/apps/basicNetwork/php
