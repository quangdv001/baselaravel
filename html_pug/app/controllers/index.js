module.exports = {
    home: (req, res) => {
        const params = {
            title: 'Home-page'
        }
        return res.render('home', params)
    }
}