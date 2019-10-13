import React, { Component } from 'react'
import './App.css'
import List from './List';
import Header from './Header';

export default class App extends Component {
    constructor(props) {
        super(props)
        this.state = {
            term: '',
            items: []
        }
    }

    /*componentDidMount() {
    getList().then(data => {
      //console.log(data);
      this.setState({
        items: [...this.state.items, ...data]
      });
    });
  }*/

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-6 mx-auto">
                    <Header />
                        <h1 className="text-center">TODO List App</h1>
                        <List/>
                    </div>
                </div>
            </div>
        )
    }
}

if (document.getElementById('root')) {

    ReactDOM.render(<App/>, document.getElementById('root'));

}
