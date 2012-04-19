/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.3
 * @author Frank Neff <frankneff.ch>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

window.eztotp = window.eztotp || {};
window.eztotp.admin = window.eztotp.admin || {};

(function ($) {

    /**
     *
     */
    var globNs = window.eztotp.admin;

    /**
     * @class UserAdmin
     */
    var UserAdmin = function () {
        var self = this;

        this.init = function () {
            jQuery(".enableUserAction").bind("click", function (event) {
                self.enableUser($(this).attr("rel"));
            });
        };

        this.enableUser = function (url) {

            var urlArray = url.split("/");
            var userId = urlArray[urlArray.length - 1];

            // change navigation elements
            $("#enableUserModal_" + userId + " .enableUserAction").remove();
            $("#enableUserModal_" + userId + " .modalCloseAction").addClass("btn-primary").removeAttr("data-dismiss").attr("disabled", "disabled").html("Close");

            var jqxhr = $.getJSON(url, function (data) {
                if (data.error) {
                    self.printError(data.errormsg);
                }
                else {

                    switch (data.action) {
                        case "none":
                            self.printSuccess("User is already active.", userId);
                            break;

                        case "created":
                            self.printSuccess("TOTP Object was successfully created. User is now active!", userId);
                            break;

                        case "enabled":
                            self.printSuccess("User activated.", userId);
                            break;
                    }
                }
            })
        };

        this.printError = function (message, id) {

        };

        this.printSuccess = function (message, id) {
            console.log("success!");
            var domObject = $('<div class="alert alert-success">' + message + '</div>');

            $("#enableUserModal_" + id + " .modal-body")
                .prepend(domObject);

            $("#enableUserModal_" + id + " .modalCloseAction")
                .removeAttr("disabled")
                .attr("data-dismiss", "modal")
                .attr("onclick", '$(".userListItem_' + id + '").hide();');
        };
    };

    /**
     * @class LogAdmin
     */
    var LogAdmin = function (limit) {
        var self = this;

        this.limit = limit;

        this.init = function () {
            $("#loadMoreLogsTrigger button").bind("click", function () {
                eztotp.admin.logAdmin.loadMore();
            });

            $("body").bind("ezTotpTableEndReached", function () {
                $("tr.loadMoreTrigger td").html("<strong>Table end reached...</strong>");
            });

            $("body").bind("ezTotpTableNoData", function () {
                $("tr.loadMoreTrigger td").html("<strong>No data available...</strong>");
            });
        };

        this.getLogData = function (offset, limit) {

            if (typeof limit !== "number") {
                limit = this.limit;
            }

            var jqxhr = $.getJSON(window.eztotp.settings.logServiceUrl + "/" + this.limit + "/" + offset, function (data) {
                if (data.error) {
                    $("body").trigger("ezTotpTableNoData");
                }
                else {

                    if (data.length == 0) {
                        // fire event to do cleanup jobs
                        $("body").trigger("ezTotpTableNoData");
                    }
                    else if (data.length < self.limit) {
                        // fire event to do cleanup jobs
                        $("body").trigger("ezTotpTableEndReached");
                    }

                    $.each(data, function (key, value) {
                        self.createLogLine(value);
                    });
                }
            })
        };

        this.createLogLine = function (data) {
            var dom = $(".logListItemDummy").clone(),
                domObject = $(dom);

            domObject.removeClass("logListItemDummy").removeClass("uiTableFilterIgnore").addClass("logListItem_" + data.id);

            // set time
            domObject.find(".time").html(data.time);

            // set user id
            domObject.find(".user").html("<span>" + data.user.name + "</span><span>(" + data.user.id + ")</span>");

            // set ip address
            domObject.find(".ip").html(data.user.ip);

            // set level
            domObject.find(".level").html(self.createLogTypeDom(data.level));

            // set message
            domObject.find(".message").html(data.message);
            self.initializeFullMessageButton(domObject);

            $(".loadMoreTrigger").before(domObject);
            domObject.fadeIn("slow");
        };

        this.createLogTypeDom = function (level) {
            switch (level) {
                case "0":
                    return '<span class="label label-info">info</span>';
                    break;
                case "1":
                    return '<span class="label label-warning">warn</span>';
                    break;
                case "2":
                    return '<span class="label label-important">error</span>';
                    break;
            }
        };

        this.loadMore = function () {
            var offset = $('.logListItem').length - 1;
            this.getLogData(offset, this.limit);
        };

        this.initializeFullMessageButton = function (targetTr) {
            var parent = $(targetTr),
                short = $(parent.find(".message .short")),
                full = $(parent.find(".message .full"));

            console.log(full);

            if ((short.length > 0) && (full.length > 0)) {
                short.append($('<button class="displayFullMessageTrigger btn btn-mini"' +
                    'onclick="eztotp.admin.logAdmin.toggleFullMessage(this);">' +
                    'more <span class="caret"></span>' +
                    '</button><div class="clear"></div>'));
            }


        };

        this.toggleFullMessage = function (button) {
            $(button).closest("tr").find(".message .full").toggle();
            if ($(button).html() == 'more <span class="caret"></span>') {
                $(button).html('less <span class="caret"></span>');
            }
            else {
                $(button).html('more <span class="caret"></span>');
            }
        }
    };

    /**
     * @class LogAdmin
     */
    var TableFilter = function (limit) {
        var self = this;

        this.table = $("table.canBeFiltered");

        this.init = function () {

            if (this.checkTargetTable()) {
                // set filter dom
                var filterDom = '<div class="tableFilter">' +
                    '<input type="text" class="input-small tableFilterInput" placeholder="Filter">' +
                    '<button class="btn btn-small clearFilter">clear</button>' +
                    '</div>';
                this.table.before(filterDom);

                // bind filter event
                $("input.tableFilterInput")
                    .bind("change", function (event) {
                        self.doFilter(this);
                    })
                    .bind("keyup", function (event) {
                        console.log("keydown");
                        self.doFilter(this);
                    });

                // bind clear button
                $("button.clearFilter").bind("click", function (event) {
                    self.resetFilter();
                });

            }
        };

        this.checkTargetTable = function () {
            if (this.table.length < 1) {
                return false;
            }
            else if (this.table.length > 1) {
                this.table = this.table[0];
            }
            this.table = $(this.table);

            return true;
        };

        this.doFilter = function (inputObject) {

            $.uiTableFilter(self.table, $(inputObject).val());
        };

        this.resetFilter = function () {
            $("input.tableFilterInput").val("").trigger("change");
        };
    };


    $(document).ready(function () {
        // bind namespaces
        globNs.userAdmin = new UserAdmin();
        globNs.logAdmin = new LogAdmin(10);
        globNs.tableFilter = new TableFilter();

        // fire init
        globNs.userAdmin.init();
        globNs.logAdmin.init();
        globNs.tableFilter.init();


    });


})(jQuery);