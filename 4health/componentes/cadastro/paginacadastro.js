import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Title from "./componentes/cadastro/titulo"
import Main from './componentes/cadastro/main';

export default function App() {
  return (
    <View style={styles.container}>
      <Title/>
      <Main/>
      <Text>ajuda?</Text>
    </View>
  );
}