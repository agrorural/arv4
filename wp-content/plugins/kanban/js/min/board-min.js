function Board(t){$(document).trigger("/board/init/",t),this.record=t,this.$el=$("#board-{0}".sprintf(t.id()));var e=new User(this.record.allowed_users()[this.record.current_user_id()]);this.current_user=function(){return e},this.dom();var s=this;setTimeout(function(){var t=obj_order_by_prop(s.record.tasks,"position",!0);for(var e in t){var r=t[e],a=s.record.tasks[r.id]=new Task(s.record.tasks[r.id]);a.add_to_board()}s.update_UI(),$(document).trigger("/board/tasks/done/",s.$el)},50)}Board.prototype.dom=function(){var t=this;return $(document).trigger("/board/dom/",t.$el),t.$el.on("click",".col-tasks-sidebar",function(e){if("click"==e.type&&is_dragging)return!1;var s=$(this),r=$(".row-statuses, .row-tasks",t.$el);if(r.is(":animated"))return!1;var a=s.attr("data-left"),o=s.attr("data-right");return s.hasClass("opened")?(s.removeClass("opened"),a=o):s.addClass("opened"),$(".col-tasks-sidebar",t.$el).not(s).removeClass("opened"),r.animate({marginLeft:a},300),!1}),t.$el.on("change",".modal-filter select",function(){var e=$(this),s=e.attr("data-field"),r=e.val();return t.record.filters[s]=r,t.apply_filters(),!1}).on("show.bs.modal",".modal-filter",function(){var e=$(this),s=$(".select-projects",e),r=$("option:first",s),a=$("option:last",s);$("option",s).not(r).not(a).remove();for(var o in t.record.project_records){var i=t.record.project_records[o],d=templates[t.record.id()]["t-option-project"].render(i);$(d).insertAfter(r),t.apply_filters()}}),t.$el.on("click",".btn-status-toggle",function(){var e=$(this),s=e.closest(".col"),r=s.siblings().andSelf(),a=parseInt(e.attr("data-operator")),o=s.index()+a;0>o&&(o=r.length-1),o>=r.length&&(o=0),t.status_cols_toggle(o)}),t.current_user().has_cap("write")?($(".col-tasks",t.$el).sortable({connectWith:".col-tasks",handle:".task-handle",forcePlaceholderSize:!0,forceHelperSize:!0,placeholder:"task-placeholder",containment:$(".row-tasks-wrapper",t.$el),appendTo:"body",scroll:!1,helper:"clone",start:function(e,s){$(".dropdown.open",t.$el).removeClass("open").closest(".col-tasks.active").removeClass("active"),$(".col-tasks-sidebar").css({left:"",right:""}),is_dragging=!0},stop:function(){t.update_task_positions(),is_dragging=!1},receive:function(e,s){var r=s.item.closest(".col-tasks"),a=s.item.attr("data-id"),o=t.record.tasks[a],i=o.record.status_id,d=t.record.status_records()[i],n=r.attr("data-status-id"),c=t.record.status_records()[n],l=text.task_moved_to_status.sprintf(t.current_user().record().short_name,c.title);l+=text.task_moved_to_status_previous.sprintf(d.title),"undefined"!=typeof t.record.settings().default_assigned_to_first&&(1!=t.record.settings().default_assigned_to_first||"undefined"!=typeof o.record.user_id_assigned&&0!=o.record.user_id_assigned||(o.record.user_id_assigned=t.current_user().record().ID,o.update_assigned_to(t.current_user().record().ID))),o.record.status_id=n,o.save(l),t.record.tasks[a].update_status(n),t.update_UI()}}),t.$el.on("mouseenter",".col-tasks",function(){var t=$(this),e=t.attr("data-status-id");return $("#status-"+e).trigger("mouseenter"),!1}).on("mouseleave",".col-tasks",function(){var t=$(this),e=t.attr("data-status-id");return $("#status-"+e).trigger("mouseleave"),!1}).on("shown.bs.dropdown",".col-tasks .dropdown",function(){var t=$(this),e=t.closest(".col-tasks");return e.addClass("active"),!1}).on("hidden.bs.dropdown",".col-tasks .dropdown",function(){var t=$(this),e=t.closest(".col-tasks");return e.removeClass("active"),!1}),t.$el.on("mouseenter",".col-status",function(){var t=$(this),e=t.attr("data-id");return $(".btn-group-status-actions",t).show(),!1}).on("mouseleave",".col-status",function(){var t=$(this),e=t.attr("data-id");return $(".btn-group-status-actions",t).hide(),!1}),t.$el.on("click",".btn-task-new",function(){var e=$(this);$(".glyphicon",e).toggle();var s=e.attr("data-status-id"),r={task:{status_id:s,board_id:t.record.id()},comment:"{0} added the task".sprintf(t.current_user().record().short_name)};"undefined"!=typeof t.record.settings().default_estimate&&"undefined"!=typeof t.record.estimate_records()[t.record.settings().default_estimate]&&(r.task.estimate_id=t.record.settings().default_estimate);try{1==t.record.settings().default_assigned_to_creator&&(r.task.user_id_assigned=t.current_user().record().ID)}catch(a){}if("undefined"!=typeof t.record.settings().default_assigned_to&&"undefined"!=typeof t.record.allowed_users()[t.record.settings().default_assigned_to]){var o=!0;try{1!=t.record.settings().default_assigned_to_creator&&1!=t.record.settings().default_assigned_to_first||(o=!1)}catch(a){}o&&(r.task.user_id_assigned=t.record.settings().default_assigned_to)}return r.action="save_task",r.kanban_nonce=$("#kanban_nonce").val(),$.ajax({method:"POST",url:ajaxurl,data:r}).done(function(s){$(".glyphicon",e).toggle();try{if(!s.success)return growl(text.task_added_error),!1;0===Object.keys(t.record.tasks).length&&(t.record.tasks={});var r=t.record.tasks[s.data.task.id]=new Task(s.data.task);r.add_to_board(),t.update_UI(),$(".task-title",t.record.tasks[s.data.task.id].$el).focus()}catch(a){}}),!1}),t.$el.on("click",".btn-status-empty",function(){var e=window.confirm(text.status_empty_confirm);if(e){var s=$(this),r=s.attr("data-status-id");$(".glyphicon",s).toggle();for(var a in t.record.tasks){var o=t.record.tasks[a];o.record.status_id==r&&o["delete"]()}setTimeout(function(){$(".glyphicon",s).toggle()},2e3)}return!1}),t.$el.on("click",".modal-task-move .list-group-item",function(){var e=$(this),s=e.closest(".modal"),r=$("input.task-id",s),a=r.val(),o=t.record.tasks[a],i=e.attr("data-status-id");o.record.status_id=i,o.save();var d=$("#task-"+a);setTimeout(function(){d.slideUp("fast",function(){o.update_status(i),$(this).prependTo("#status-"+i+"-tasks").slideDown("fast")})},300),t.match_col_h(),t.updates_status_counts()}),$(window).resize(function(){$(".col-tasks",t.$el).sortable("xs"==screen_size?"disable":"enable")}),void $(".col-tasks",t.$el).sortable("xs"==screen_size?"disable":"enable")):!1},Board.prototype.updates_status_counts=function(){$(".col-tasks",this.$el).each(function(){var t=$(this),e=$(".task",t).length,s=t.attr("data-status-id");$("#status-"+s+" .status-task-count").text(e)})},Board.prototype.update_task_positions=function(){var t=this;$(".col-tasks",this.$el).each(function(){var e=$(this);$(".task",e).each(function(e){var s=$(this),r=s.attr("data-id"),a=t.record.tasks[r];a.update_position(("00000"+e).slice(-5))})})},Board.prototype.match_col_h=function(){$(".col-tasks",this.$el).matchHeight({minHeight:window_h})},Board.prototype.apply_filters=function(){var t=this,e=[],s=!1;for(var r in this.record.filters){var a=this.record.filters[r];if(null!==a&&""!==a){s=!0;for(var o in this.record.tasks){var i=this.record.tasks[o];i.record[r]!=a&&e.push("#task-"+o)}$('.modal-filter select[data-field="{0}"]'.sprintf(r),this.$el).val(a)}}s?$(".btn-filter-reset").show():$(".btn-filter-reset").hide();var d=$(e.join(","));d.slideUp("fast"),$(".task").not(d).slideDown("fast"),$(".task",this.$el).promise().done(function(){t.match_col_h()}),url_params=$.extend(url_params,{filters:this.record.filters}),update_url()},Board.prototype.project_update_counts=function(){var t=[];for(var e in this.record.tasks){var s=this.record.tasks[e];"undefined"!=typeof s.record.project_id&&("undefined"==typeof t[s.record.project_id]&&(t[s.record.project_id]=0),t[s.record.project_id]++)}for(var r in this.record.project_records)"undefined"!=typeof t[r]?this.record.project_records[r].task_count=t[r]:this.record.project_records[r].task_count=0},Board.prototype.update_UI=function(){this.updates_status_counts(),this.match_col_h()},Board.prototype.status_cols_toggle=function(t){url_params.col_index=t,update_url(),$(".row-statuses, .row-tasks",this.$el).each(function(){var e=$(this),s=$("> .col",e),r=s.eq(t).show();s.not(r).hide()})};