<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
Yii::app()->clientScript->registerPackage('app');
?><div data-bind="css: { 'not-loaded': loaded() }">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="progress progress-striped active">
                <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    <span>Загрузка расширения GE HR...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="not-loaded" data-bind="css: { 'not-loaded': !loaded() }">

    

        <div class="row">
            <div class="col-md-4">
                <div data-bind="visible: page() === 'index'">
                    <button data-bind="click: showContactUrls, visible: contactUrls().length > 1" class="btn btn-success" title="Ссылки"><span class="glyphicon glyphicon-align-left"></span> <span data-bind="html: contactUrls().length" class="badge"></span></button>
                    <button data-bind="click: showComments, visible: comments().length > 0 && sanitizedGuestUrl()" class="btn btn-success" title="Отзывы"><span class="glyphicon glyphicon-comment"></span> <span data-bind="visible: comments().length, html: comments().length" class="badge"></span></button>
                    <button data-bind="click: showContacts, visible: contacts().length > 0 && isPrivilegedUser()" class="btn btn-success" title="Контакты"><span class="glyphicon glyphicon-earphone"></span> <span data-bind="html: contacts().length" class="badge"></span></button>
                    <button data-bind="click: showPostComment, visible: sanitizedGuestUrl() && isPrivilegedUser()" class="btn btn-primary" title="Написать отзыв"><span class="glyphicon glyphicon-pencil"></span></button>

                    <div draggable="true" id="mergeButton" class="btn btn-danger" title="Объединить" data-bind="visible: sanitizedGuestUrl() && isPrivilegedUser()"><span class="glyphicon glyphicon-retweet"></span></div>
                </div>
                <div data-bind="visible:page() !== 'index'">
                     <h4><button data-bind="click: showIndex" class="btn"><span class="glyphicon glyphicon-chevron-left"></span></button> <span data-bind="html: title"></span></h4>
                </div>
            </div>
            <div class="col-md-8">
                <div class="pull-right">
                    <div data-bind="visible: !logged()">
                        <form class="form-inline" role="form">
                            <div data-bind="css: { 'has-error': hasError('email') }" class="form-group">
                                <input id="email" data-bind="value: email" type="email" class="form-control" placeholder="Введите логин">
                            </div>
                            <div data-bind="css: { 'has-error': hasError('password') }" class="form-group">
                                <input data-bind="value: password" type="password" class="form-control" placeholder="Введите пароль">
                            </div>
                            <button data-bind="click: login" class="btn btn-success">Войти</button>
                            или
                            <button data-bind="click: register" class="btn btn-primary">Зарегистрироваться</button>
                        </form>
                    </div>

                    <div data-bind="visible: logged()">
                        <span data-bind="html: email"></span>
                        <button data-bind="click: logout" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span></button>
                        <button data-bind="click: showAddFeedback" class="btn btn-danger" title="Сообщить о проблеме"><span class="glyphicon glyphicon-flash"></span></button>
                        <button data-bind="click: showStats, visible: maySeeStats" class="btn btn-danger" title="Статистика"><span class="glyphicon glyphicon-tasks"></span></button>
                    </div>
                </div>
            </div>
        </div>

        <hr data-bind="visible: page() !== 'index'" />

        <div class="row">
            <div data-bind="visible: page() === 'merge'" class="col-md-12">
                <div class="scrollable">
                    <form role="form">
                        <div class="checkbox">
                            <label><input type="checkbox" checked disabled> Текущая</label>
                        </div>                    
                        <div data-bind="foreach: newTabs">
                            <div class="checkbox">
                                <label><input type="checkbox" data-bind="value: $data.url, checked: $parent.mergedUrls, attr: { id: 'tab_' + $index() }"> <span data-bind="html: $data.title"></span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button data-bind="click: doMerge, enable: mergedUrls().length" class="btn btn-success">Объединить</button>
                        </div>
                    </form>
                </div>
            </div><!-- merge -->

            <div data-bind="visible: page() === 'urls'" class="col-md-12">
                <div class="scrollable">
                    <table class="table table-striped">
                        <tbody data-bind="foreach: contactUrls">
                            <tr>
                                <td data-bind="html: $data.created"></td>
                                <td><a data-bind="html: $data.url, attr: { href: $data.url }" href="#" target="_blank"></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- urls -->

            <div data-bind="visible: page() === 'contacts'" class="col-md-12">
                <div class="scrollable">
                    <table class="table table-striped">
                        <tbody data-bind="foreach: contacts">
                            <tr>
                                <td data-bind="html: $data.created"></td>
                                <td data-bind="html: $data.contacts.replace(/\n/g, '<br/>')"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- contacts -->

            <div data-bind="visible: page() === 'comments'">
                <div class="col-md-12">
                    <div data-bind="visible: comments().length" class="scrollable">
                        <table class="table">
                            <tbody data-bind="foreach: comments">
                                <tr data-bind="attr: { 'class': $parent.types()[$data.type].className }">
                                    <td><span data-bind="html: $data.created"></span><br/><b data-bind="html: $data.user || 'Неизвестный'"></b></td>
                                    <td data-bind="html: $parent.types()[$data.type].name"></td>
                                    <td data-bind="html: $data.text"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p data-bind="visible: !comments().length">Пока отзывов нет.</p>
                </div>
            </div><!-- comments -->

            <div data-bind="visible: page() === 'postComment'">
                <div class="col-md-4">
                    <form role="form">
                        <div class="form-group">
                            <select data-bind="options: types, optionsText: 'name', optionsValue: 'id', value: commentType" class="form-control"></select>
                        </div>
                        <div data-bind="css: { 'has-error': hasError('text') }" class="form-group">
                            <textarea id="comment" data-bind="value: commentText, valueUpdate: 'keyup'" class="form-control" placeholder="Текст сообщения" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <button data-bind="click: doAddComment, disable: !commentText()" class="btn btn-success">Отправить</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div data-bind="visible: comments().length" class="scrollable">
                        <table class="table">
                            <tbody data-bind="foreach: comments">
                                <tr data-bind="attr: { 'class': $parent.types()[$data.type].className }">
                                    <td><span data-bind="html: $data.created"></span><br/><b data-bind="html: $data.user || 'Неизвестный'"></b></td>
                                    <td data-bind="html: $parent.types()[$data.type].name"></td>
                                    <td data-bind="html: $data.text"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p data-bind="visible: !comments().length">Пока отзывов нет.</p>
                </div>
            </div><!-- comments -->

            <div data-bind="visible: page() === 'feedback'">
                <div class="col-md-12">
                    <form role="form">
                        <input type="hidden" name="url" data-bind="value: guestUrl()"/>
                        <div data-bind="css: { 'has-error': hasError('text') }" class="form-group">
                            <textarea id="feedback" data-bind="value: feedbackText, valueUpdate: 'keyup'" class="form-control" placeholder="Текст сообщения" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <button data-bind="click: doAddFeedback, disable: !feedbackText()" class="btn btn-success">Отправить</button>
                        </div>
                    </form>
                </div>
            </div><!-- feedback -->

            <div data-bind="visible: page() === 'stats'">
                <div class="col-md-12 scrollable">
                    <table class="table">
                        <thead>
                            <tr><th></th><th>Всего</th><th>За день</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Контакты</td>
                                <td data-bind="html: stats() ? stats().contacts.total : '?'"></td>
                                <td data-bind="html: stats() ? stats().contacts.perDay : '?'"></td>
                            </tr>
                            <tr>
                                <td>Ссылки</td>
                                <td data-bind="html: stats() ? stats().urls.total : '?'"></td>
                                <td data-bind="html: stats() ? stats().urls.perDay : '?'"></td>
                            </tr>
                            <tr>
                                <td>HH</td>
                                <td data-bind="html: stats() ? (stats().soc.total.hh || 0) : '?'"></td>
                                <td data-bind="html: stats() ? (stats().soc.perDay.hh || 0) : '?'"></td>
                            </tr>
                            <tr>
                                <td>LinkedIn</td>
                                <td data-bind="html: stats() ? (stats().soc.total.lin || 0) : '?'"></td>
                                <td data-bind="html: stats() ? (stats().soc.perDay.lin || 0) : '?'"></td>
                            </tr>
                            <tr>
                                <td>МойКруг</td>
                                <td data-bind="html: stats() ? (stats().soc.total.mk || 0) : '?'"></td>
                                <td data-bind="html: stats() ? (stats().soc.perDay.mk || 0) : '?'"></td>
                            </tr>
                            <tr>
                                <td>Остальное</td>
                                <td data-bind="html: stats() ? (stats().soc.total.other || 0) : '?'"></td>
                                <td data-bind="html: stats() ? (stats().soc.perDay.other || 0) : '?'"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- stats -->
        </div><!-- .row -->
    </div><!-- logged -->
</div>