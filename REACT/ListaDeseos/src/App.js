import './App.css';
import { Component } from 'react';
class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      euros: 0,
      dolares: 0,
      forumula: 1.20,
    };
  }

  aumentar() {
    let aux = this.state.euros + 1
    this.setState({ euros: aux });
  }

  disminuir() {
    let aux = this.state.euros - 1
    if(aux>=0){
      this.setState({ euros: aux });
    }
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <div>
            <h2>{this.state.euros} EUROS</h2>
            <button onClick={()=>this.aumentar()}>
              aumentar
            </button>
            <button onClick={()=>this.disminuir()}>
              disminiuir
            </button>
            <div>Equivale a {Math.round(this.state.euros*this.state.forumula*100)/100} Dólares</div>
          </div>
        </header>
      </div>
    );
  }
}

export default App;
