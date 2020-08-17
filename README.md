# Memory Game

This classic game can be set up by placing images in the image folder and by editen the config.json file.

## Setup

In the config.json file you need to specify the domains property which contains alle the domains which are installed.
Each domain can have a different back-face image which relative of absolute location is specified by the "back-face" property.
Each domain has one or more levels that are specified with the "levels" property.
Like the domains also the levels can have self choosen names, but normally a (alphabetic) numbering is used to indicate to the user the order.
Each level has one or more playgrounds ("playgrounds" property) with names as the levels, so free but best to indicate the progress in that name too.
Each playground can have the following optional properties
* __"syntax"__: this property can have one or two properties "original" and "match", which specify the prefix of the filename before numbering from _00_ to _20_. In the "match" property is omitted, the file specified by the original is also used as matching file (so used twice). When this property is omitted the filename is assumed to have no prefixes AND that the apllication should use the orginal file twice as matching copy.
* __"path"__: this property is used to overrule the default path (/image/domains/level/playground/) of the location. This can also be a url path.
* __"type"__: this property is used to overrule the default type (svg) of the image.