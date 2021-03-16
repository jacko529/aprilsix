/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import ReactDOM from "react-dom";

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import React from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import { Redirect } from 'react-router'
import Products from './components/Tables/Products';
import Customers from './components/Tables/Customers';
import Home from './components/Home';
import Sidebar from './components/Dash/Sidebar';
import CustomerSales from './components/Tables/CustomersSales';
import Header from "./components/Header";
import Search from './components/Dash/Search'

const App = () => {
    return (
        <Router>
            <Header/>
            <Sidebar/>
                <Switch>
                    <Route path='/products' component={Products} />
                    <Route path='/customers' component={Customers} />
                    <Route path='/customers-sales' component={CustomerSales} />
                    <Route path='/home' component={Home} />
                    <Route path='/search' component={Search} />
                    <Route
                        exact
                        path="/"
                        render={() => {
                            return (
                                <Redirect to="/home" />
                            )
                        }}
                    />
                </Switch>
        </Router>
    );
};

export default App;

ReactDOM.render(<App />, document.getElementById('app'));
