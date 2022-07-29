//import { StatusBar } from 'expo-status-bar';
import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Title from "./componentes/titulo"
import Main from './componentes/main';

export default function App() {
  return (
    <View style={styles.container}>
      <Title/>
      <Main/>
      <Text>ajuda?</Text>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#88C3E3',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
