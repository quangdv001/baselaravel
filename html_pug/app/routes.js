var Ctrl = require('./controllers/index')

module.exports = function (app) {
    app.get('/index.html', Ctrl.home);
    
    app.get('/', Ctrl.home);
    app.get('/category.html',  (req, res) => {
	    return res.render('category')
    });	
    app.get('/single.html',  (req, res) => {
	    return res.render('single')
    });	
    app.get('/contact.html',  (req, res) => {
	    return res.render('contact')
    });	
    app.get('/courses.html',  (req, res) => {
	    return res.render('courses')
    });	
    app.get('/courses-detail.html',  (req, res) => {
	    return res.render('courses-detail')
    });	

    app.use(function(req, res, next) {
        var err = new Error('Not Found');
        err.status = 404;
        next(err);
    });
    app.use(function(err, req, res, next) {
        // set locals, only providing error in development
        res.locals.message = err.message;
        res.locals.error = req.app.get('env') === 'development' ? err : {};
        
        // render the error page
        res.status(err.status || 500);
        res.render('error', err);
    });
}
