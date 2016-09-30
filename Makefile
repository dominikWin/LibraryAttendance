HOSTED_NAME=libraryattendance
FILES=admin config css fonts includes index.html interface js login.php

RM=rm -f
BUILD_DIR=build

SERVER_WWW=/var/www

.PHONY: _build
_build: clean
	mkdir $(BUILD_DIR)
	mkdir $(BUILD_DIR)/$(HOSTED_NAME)
	cp -r $(FILES) $(BUILD_DIR)/$(HOSTED_NAME)

.PHONY: clean
clean:
	$(RM) -r $(BUILD_DIR)

.PHONY: _out_tgz
_out_tgz: _build
	cd $(BUILD_DIR); \
		tar cfz $(HOSTED_NAME).tar.gz $(HOSTED_NAME)

.PHONY: _out_txz
_out_txz: _build
	cd $(BUILD_DIR); \
		tar cfJ $(HOSTED_NAME).tar.xz $(HOSTED_NAME)

.PHONY: _out_zip
_out_zip: _build
	cd $(BUILD_DIR); \
		zip -r -q $(HOSTED_NAME).zip $(HOSTED_NAME)

out: _out_tgz _out_txz _out_zip

deploy: clean _out_tgz
	scp $(BUILD_DIR)/$(HOSTED_NAME).tar.gz $(SERVER):$(SERVER_WWW)/
	ssh $(SERVER) "cd /$(SERVER_WWW) && rm -rf $(HOSTED_NAME) && tar xf $(HOSTED_NAME).tar.gz && rm -f $(HOSTED_NAME).tar.gz; exit"
