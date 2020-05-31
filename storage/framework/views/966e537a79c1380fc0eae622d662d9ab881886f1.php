<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('installer_messages.environment.wizard.templateTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    <?php echo trans('installer_messages.environment.wizard.title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
    <div class="tabs tabs-full">

        <input id="tab1" type="radio" name="tabs" class="tab-input" checked />
        <label for="tab1" class="tab-label">
            <i class="fa fa-cog fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            <?php echo e(trans('installer_messages.environment.wizard.tabs.environment')); ?>

        </label>

        <input id="tab2" type="radio" name="tabs" class="tab-input" />
        <label for="tab2" class="tab-label">
            <i class="fa fa-database fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            <?php echo e(trans('installer_messages.environment.wizard.tabs.database')); ?>

        </label>

        <input id="tab3" type="radio" name="tabs" class="tab-input" />
        <label for="tab3" class="tab-label">
            <i class="fa fa-cogs fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            <?php echo e(trans('installer_messages.environment.wizard.tabs.application')); ?>

        </label>

        <form method="post" action="<?php echo e(route('LaravelInstaller::environmentSaveWizard')); ?>" class="tabs-wrap">
            <div class="tab" id="tab1content">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <div class="form-group <?php echo e($errors->has('app_name') ? ' has-error ' : ''); ?>">
                    <label for="app_name">
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_name_label')); ?>

                    </label>
                    <input type="text" name="app_name" id="app_name" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_name_placeholder')); ?>" />
                    <?php if($errors->has('app_name')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('app_name')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                
                <input type="hidden" value="local" name="environment"/>

               <!-- <div class="form-group <?php echo e($errors->has('environment') ? ' has-error ' : ''); ?>">
                    <label for="environment">
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_environment_label')); ?>

                    </label>
                    <select name="environment" id="environment" onchange='checkEnvironment(this.value);'>
                        <option value="local" selected><?php echo e(trans('installer_messages.environment.wizard.form.app_environment_label_local')); ?></option>
                        <option value="development"><?php echo e(trans('installer_messages.environment.wizard.form.app_environment_label_developement')); ?></option>
                        <option value="qa"><?php echo e(trans('installer_messages.environment.wizard.form.app_environment_label_qa')); ?></option>
                        <option value="production"><?php echo e(trans('installer_messages.environment.wizard.form.app_environment_label_production')); ?></option>
                        <option value="other"><?php echo e(trans('installer_messages.environment.wizard.form.app_environment_label_other')); ?></option>
                    </select>
                    <div id="environment_text_input" style="display: none;">
                        <input type="text" name="environment_custom" id="environment_custom" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_environment_placeholder_other')); ?>"/>
                    </div>
                    <?php if($errors->has('environment')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('environment')); ?>

                        </span>
                    <?php endif; ?>
                </div> -->

               <input type="hidden" value="false" name="app_debug"/>
               
                <!-- <div class="form-group <?php echo e($errors->has('app_debug') ? ' has-error ' : ''); ?>">
                    <label for="app_debug">
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_debug_label')); ?>

                    </label>
                    <label for="app_debug_true">
                        <input type="radio" name="app_debug" id="app_debug_true" value=true checked />
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_debug_label_true')); ?>

                    </label>
                    <label for="app_debug_false">
                        <input type="radio" name="app_debug" id="app_debug_false" value=false />
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_debug_label_false')); ?>

                    </label>
                    <?php if($errors->has('app_debug')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('app_debug')); ?>

                        </span>
                    <?php endif; ?>
                </div> -->

                <input type="hidden" value="debug" name="app_log_level"/>
                
                <!-- <div class="form-group <?php echo e($errors->has('app_log_level') ? ' has-error ' : ''); ?>">
                    <label for="app_log_level">
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_log_level_label')); ?>

                    </label>
                    <select name="app_log_level" id="app_log_level">
                        <option value="debug" selected><?php echo e(trans('installer_messages.environment.wizard.form.app_log_level_label_debug')); ?></option>
                        <option value="info"><?php echo e(trans('installer_messages.environment.wizard.form.app_log_level_label_info')); ?></option>
                        <option value="notice"><?php echo e(trans('installer_messages.environment.wizard.form.app_log_level_label_notice')); ?></option>
                        <option value="warning"><?php echo e(trans('installer_messages.environment.wizard.form.app_log_level_label_warning')); ?></option>
                        <option value="error"><?php echo e(trans('installer_messages.environment.wizard.form.app_log_level_label_error')); ?></option>
                        <option value="critical"><?php echo e(trans('installer_messages.environment.wizard.form.app_log_level_label_critical')); ?></option>
                        <option value="alert"><?php echo e(trans('installer_messages.environment.wizard.form.app_log_level_label_alert')); ?></option>
                        <option value="emergency"><?php echo e(trans('installer_messages.environment.wizard.form.app_log_level_label_emergency')); ?></option>
                    </select>
                    <?php if($errors->has('app_log_level')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('app_log_level')); ?>

                        </span>
                    <?php endif; ?>
                </div> -->

                <div class="form-group <?php echo e($errors->has('app_url') ? ' has-error ' : ''); ?>">
                    <label for="app_url">
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_url_label')); ?>

                    </label>
                    <input type="url" name="app_url" id="app_url" value="http://localhost" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_url_placeholder')); ?>" />
                    <?php if($errors->has('app_url')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('app_url')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="buttons">
                    <button class="button" onclick="showDatabaseSettings();return false">
                        <?php echo e(trans('installer_messages.environment.wizard.form.buttons.setup_database')); ?>

                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab2content">

                <div class="form-group <?php echo e($errors->has('database_connection') ? ' has-error ' : ''); ?>">
                    <label for="database_connection">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_connection_label')); ?>

                    </label>
                    <b>mysql</b>
                    <input type="hidden" name="database_connection" value="mysql"/>
                    <br><br>
                    <!-- <select name="database_connection" id="database_connection">
                        <option value="mysql" selected><?php echo e(trans('installer_messages.environment.wizard.form.db_connection_label_mysql')); ?></option>
                        <option value="sqlite"><?php echo e(trans('installer_messages.environment.wizard.form.db_connection_label_sqlite')); ?></option>
                        <option value="pgsql"><?php echo e(trans('installer_messages.environment.wizard.form.db_connection_label_pgsql')); ?></option>
                        <option value="sqlsrv"><?php echo e(trans('installer_messages.environment.wizard.form.db_connection_label_sqlsrv')); ?></option>
                    </select>
                    <?php if($errors->has('database_connection')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_connection')); ?>

                        </span>
                    <?php endif; ?> -->
                </div>

                <div class="form-group <?php echo e($errors->has('database_hostname') ? ' has-error ' : ''); ?>">
                    <label for="database_hostname">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_host_label')); ?>

                    </label>
                    <input type="text" name="database_hostname" id="database_hostname" value="127.0.0.1" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.db_host_placeholder')); ?>" />
                    <?php if($errors->has('database_hostname')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_hostname')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo e($errors->has('database_port') ? ' has-error ' : ''); ?>">
                    <label for="database_port">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_port_label')); ?>

                    </label>
                    <input type="number" name="database_port" id="database_port" value="3306" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.db_port_placeholder')); ?>" />
                    <?php if($errors->has('database_port')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_port')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo e($errors->has('database_name') ? ' has-error ' : ''); ?>">
                    <label for="database_name">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_name_label')); ?>

                    </label>
                    <input type="text" name="database_name" id="database_name" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.db_name_placeholder')); ?>" />
                    <?php if($errors->has('database_name')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_name')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo e($errors->has('database_username') ? ' has-error ' : ''); ?>">
                    <label for="database_username">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_username_label')); ?>

                    </label>
                    <input type="text" name="database_username" id="database_username" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.db_username_placeholder')); ?>" />
                    <?php if($errors->has('database_username')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_username')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo e($errors->has('database_password') ? ' has-error ' : ''); ?>">
                    <label for="database_password">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_password_label')); ?>

                    </label>
                    <input type="password" name="database_password" id="database_password" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.db_password_placeholder')); ?>" />
                    <?php if($errors->has('database_password')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_password')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="buttons">
                    <button class="button" onclick="showApplicationSettings();return false">
                        <?php echo e(trans('installer_messages.environment.wizard.form.buttons.setup_application')); ?>

                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab3content">
                <div class="block" style="display: none">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab1" value="null" checked />
                    <label for="appSettingsTab1">
                        <span>
                            <?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.broadcasting_title')); ?>

                        </span>
                    </label>







                    <div class="info">
                        <div class="form-group <?php echo e($errors->has('broadcast_driver') ? ' has-error ' : ''); ?>">
                            <label for="broadcast_driver"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.broadcasting_label')); ?>

                                <sup>
                                    <a href="https://laravel.com/docs/5.4/broadcasting" target="_blank" title="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?>">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?></span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="broadcast_driver" id="broadcast_driver" value="log" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.broadcasting_placeholder')); ?>" />
                            <?php if($errors->has('broadcast_driver')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('broadcast_driver')); ?>

                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?php echo e($errors->has('cache_driver') ? ' has-error ' : ''); ?>">
                            <label for="cache_driver"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.cache_label')); ?>

                                <sup>
                                    <a href="https://laravel.com/docs/5.4/cache" target="_blank" title="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?>">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?></span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="cache_driver" id="cache_driver" value="file" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.cache_placeholder')); ?>" />
                            <?php if($errors->has('cache_driver')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('cache_driver')); ?>

                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?php echo e($errors->has('session_driver') ? ' has-error ' : ''); ?>">
                            <label for="session_driver"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.session_label')); ?>

                                <sup>
                                    <a href="https://laravel.com/docs/5.4/session" target="_blank" title="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?>">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?></span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="session_driver" id="session_driver" value="file" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.session_placeholder')); ?>" />
                            <?php if($errors->has('session_driver')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('session_driver')); ?>

                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?php echo e($errors->has('queue_driver') ? ' has-error ' : ''); ?>">
                            <label for="queue_driver"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.queue_label')); ?>

                                <sup>
                                    <a href="https://laravel.com/docs/5.4/queues" target="_blank" title="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?>">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?></span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="queue_driver" id="queue_driver" value="sync" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.queue_placeholder')); ?>" />
                            <?php if($errors->has('queue_driver')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('queue_driver')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="block" style="display: none">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab2" value="null"/>
                    <label for="appSettingsTab2">
                        <span>
                            <?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.redis_label')); ?>

                        </span>
                    </label>
                    <div class="info">
                        <div class="form-group <?php echo e($errors->has('redis_hostname') ? ' has-error ' : ''); ?>">
                            <label for="redis_hostname">
                                <?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.redis_host')); ?>

                                <sup>
                                    <a href="https://laravel.com/docs/5.4/redis" target="_blank" title="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?>">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?></span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="redis_hostname" id="redis_hostname" value="127.0.0.1" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.redis_host')); ?>" />
                            <?php if($errors->has('redis_hostname')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('redis_hostname')); ?>

                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?php echo e($errors->has('redis_password') ? ' has-error ' : ''); ?>">
                            <label for="redis_password"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.redis_password')); ?></label>
                            <input type="password" name="redis_password" id="redis_password" value="null" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.redis_password')); ?>" />
                            <?php if($errors->has('redis_password')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('redis_password')); ?>

                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?php echo e($errors->has('redis_port') ? ' has-error ' : ''); ?>">
                            <label for="redis_port"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.redis_port')); ?></label>
                            <input type="number" name="redis_port" id="redis_port" value="6379" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.redis_port')); ?>" />
                            <?php if($errors->has('redis_port')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('redis_port')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="margin-bottom-2">
                    <!--<input type="radio" name="appSettingsTabs" id="appSettingsTab3" value="null"/>
                    <label for="appSettingsTab3">
                        <span>
                            <?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_label')); ?>

                        </span>
                    </label> -->
                    <div>
                        <div class="form-group <?php echo e($errors->has('mail_driver') ? ' has-error ' : ''); ?>">
                            <label for="mail_driver">
                                <?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_label')); ?>

                                <sup>
                                    <a href="https://laravel.com/docs/5.4/mail" target="_blank" title="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?>">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?></span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="mail_driver" id="mail_driver" value="smtp" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder')); ?>" />
                            <?php if($errors->has('mail_driver')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('mail_driver')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?php echo e($errors->has('mail_host') ? ' has-error ' : ''); ?>">
                            <label for="mail_host"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_host_label')); ?></label>
                            <input type="text" name="mail_host" id="mail_host" value="smtp.mailtrap.io" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder')); ?>" />
                            <?php if($errors->has('mail_host')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('mail_host')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?php echo e($errors->has('mail_port') ? ' has-error ' : ''); ?>">
                            <label for="mail_port"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_port_label')); ?></label>
                            <input type="number" name="mail_port" id="mail_port" value="2525" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder')); ?>" />
                            <?php if($errors->has('mail_port')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('mail_port')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?php echo e($errors->has('mail_username') ? ' has-error ' : ''); ?>">
                            <label for="mail_username"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_username_label')); ?></label>
                            <input type="text" name="mail_username" id="mail_username" value="null" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder')); ?>" />
                            <?php if($errors->has('mail_username')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('mail_username')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?php echo e($errors->has('mail_password') ? ' has-error ' : ''); ?>">
                            <label for="mail_password"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_password_label')); ?></label>
                            <input type="text" name="mail_password" id="mail_password" value="null" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder')); ?>" />
                            <?php if($errors->has('mail_password')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('mail_password')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?php echo e($errors->has('mail_encryption') ? ' has-error ' : ''); ?>">
                            <label for="mail_encryption"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_label')); ?></label>
                            <input type="text" name="mail_encryption" id="mail_encryption" value="null" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder')); ?>" />
                            <?php if($errors->has('mail_encryption')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('mail_encryption')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="block" style="display: none">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab4" value="null"/>
                    <label for="appSettingsTab4">
                        <span>
                            <?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.pusher_label')); ?>

                        </span>
                    </label>
                    <div class="info">
                        <div class="form-group <?php echo e($errors->has('pusher_app_id') ? ' has-error ' : ''); ?>">
                            <label for="pusher_app_id">
                                <?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_id_label')); ?>

                                <sup>
                                    <a href="https://pusher.com/docs/server_api_guide" target="_blank" title="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?>">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.more_info')); ?></span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="pusher_app_id" id="pusher_app_id" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_id_palceholder')); ?>" />
                            <?php if($errors->has('pusher_app_id')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('pusher_app_id')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?php echo e($errors->has('pusher_app_key') ? ' has-error ' : ''); ?>">
                            <label for="pusher_app_key"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_key_label')); ?></label>
                            <input type="text" name="pusher_app_key" id="pusher_app_key" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_key_palceholder')); ?>" />
                            <?php if($errors->has('pusher_app_key')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('pusher_app_key')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?php echo e($errors->has('pusher_app_secret') ? ' has-error ' : ''); ?>">
                            <label for="pusher_app_secret"><?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_secret_label')); ?></label>
                            <input type="password" name="pusher_app_secret" id="pusher_app_secret" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_secret_palceholder')); ?>" />
                            <?php if($errors->has('pusher_app_secret')): ?>
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?php echo e($errors->first('pusher_app_secret')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button class="button" type="submit">
                        <?php echo e(trans('installer_messages.environment.wizard.form.buttons.install')); ?>

                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        function checkEnvironment(val) {
            var element=document.getElementById('environment_text_input');
            if(val=='other') {
                element.style.display='block';
            } else {
                element.style.display='none';
            }
        }
        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }
        function showApplicationSettings() {
            document.getElementById('tab3').checked = true;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\taskly\resources\views/vendor/installer/environment-wizard.blade.php ENDPATH**/ ?>